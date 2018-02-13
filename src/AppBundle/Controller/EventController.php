<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Entity\Reservation;
use AppBundle\Form\SearchType;
use AppBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\GoogleMap;

/**
 * Event controller.
 *
 * @Route("event")
 */
class EventController extends Controller
{
    /**
     * Lists all event entities.
     *
     * @Route("/",    name="event_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppBundle:Event')->getAllNotPrivateEvent($this->getUser(), null);

        $form = $this->createForm(SearchType::class, null, array(
            'action' => $this->generateUrl('result_search'),
            'method' => "post",
            'attr' => array(
                'id' => "searchFormEvent",
            )
        ));

        if ($this->getUser() != null){
            $reservations = $em->getRepository(Reservation::class)->getIdEventReservationByUser($this->getUser());
            $this->setReservation($events['public'], $reservations);
            $this->setReservation($events['private'], $reservations);
        }

        return $this->render(
            'event/index.html.twig', array(
            'events' => $events,
            'events_json' => json_encode($events),
            'formSearch' => $form->createView()
            )
        );
    }

    /**
     * @param $events
     * @param $reservations
     */
    private function setReservation($events, $reservations){
        foreach ($events as $key => $event){
            foreach ($reservations as $reservation){
                if (in_array($event->getId(), $reservation)){
                    $event->userParticipate = true;
                }
            }
        }
    }

    /**
     * Create a new event entity.
     *
     * @Route("/new",  name="event_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, FileUploader $fileUploader, GoogleMap $googleMap)
    {
        $event = new Event();
        $form = $this->createForm('AppBundle\Form\EventType', $event);
        $user = $this->getUser();

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $location = $googleMap->getLatLng($event->getAdress(), $event->getZipcode(), $event->getCity());
            $event->setLatitude($location['lat']);
            $event->setLongitude($location['lng']);


            $fileUploader->upload($event->getPicture());

            $reservation = new Reservation();
            $reservation->setDate(new \DateTime());
            $reservation->setDoParticipate(true);
            $reservation->setEvent($event);
            $reservation->setIsCreator(true);
            $reservation->setUser($this->getUser());
            $reservation->setMoneyGiven(0);

            $em->persist($reservation);
            $em->persist($event);
            $em->flush();

            /* Send Message */
            $message = (new \Swift_Message())
                ->setSubject('Nouvel Evénement OzOut')
                ->setFrom($this->getParameter('mailer_user'))
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView('email/mailNewEvent.html.twig', array(
                            'event' => $event,
                            'user' => $user
                        )
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->render(
            'event/new.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
            )
        );
    }

    /**
     * Find and display an event entity.
     *
     * @Route("/{id}", name="event_show")
     * @Method("GET")
     */
    public function showAction(Event $event)
    {

        return $this->render(
            'event/show.html.twig', array(
            'event' => $event,
            )
        );
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     * @Route("/{id}/edit", name="event_edit")
     * @Method({"GET",      "POST"})
     */
    public function editAction(Request $request, Event $event, FileUploader $fileUploader, GoogleMap $googleMap)
    {
        $editForm = $this->createForm('AppBundle\Form\EventType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $location = $googleMap->getLatLng($event->getAdress(), $event->getZipcode(), $event->getCity());
            $event->setLatitude($location['lat']);
            $event->setLongitude($location['lng']);


            //            If user upload a new File, call service fileUploader and update picture
            if ($event->getPicture()->getPictureUpload() != null) {
                $fileUploader->update($event->getPicture());

            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fos_user_profile_show', array('id' => $event->getId()));
        }

        return $this->render(
            'event/edit.html.twig', array(
            'event' => $event,
            'edit_form' => $editForm->createView(),
            )
        );
    }
    /**
     * Deletes an event entity.
     *
     * @Route("/{id}/delete", name="event_delete")
     * @Method("GET")
     * @param Event $event
     * @param FileUploader $fileUploader
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Event $event, FileUploader $fileUploader)
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);

            $reservations = $em->getRepository(Reservation::class)->findByEvent($event);
            $participants = array();
            foreach ($reservations as $key => $value){
                if ($value->getIsCreator()){
                    $creator = $value->getUser();
                } else{
                    $emails[] = $value->getUser()->getEmail();
                    $participants = $value->getUser();
                }
            }

            $fileUploader->remove($event->getPicture());

            $em->flush();

        /* Send Message Creator */
        $message = (new \Swift_Message())
            ->setSubject('L\'évènement' . " " . $event->getTitle() . " ". 'a été annulé')
            ->setFrom($this->getParameter('mailer_user'))
            ->setTo($creator->getEmail())
            ->setBody(
                $this->renderView('email/mailDeleteCreatedEvent.html.twig', array(
                        'event' => $event,
                        'creator' => $creator,

                    )
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);

        if (isset($emails)){

            /* Send Message Participants */
            $message = (new \Swift_Message())
                ->setSubject('L\'évènement' . " " . $event->getTitle() . " ". 'a été annulé')
                ->setFrom($this->getParameter('mailer_user'))
                ->setTo($emails)
                ->setBody(
                    $this->renderView('email/mailDeleteCreatedEventParticipants.html.twig', array(
                            'event' => $event,
                            'participants' => $participants,
                            'creator' => $creator
                        )
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
        }


        return $this->redirectToRoute('fos_user_profile_show');
    }

    /**
     * @Route("/{id}/invite", name="event_invite")
     * @Method({"POST", "GET"})
     */
    public function inviteAction(Event $event, Request $request){



        if ($request ->isMethod('POST')){
            /* Send Message */
            $message = (new \Swift_Message())
                ->setSubject('Invitation Evénement OzOut')
                ->setFrom($this->getParameter('mailer_user'))
                ->setTo($request->get('emails'))
                ->setBody(
                    $this->renderView('email/invitation.html.twig', array(
                            'event' => $event,
                            'user' => $this->getUser()
                        )
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->render('event/invite.html.twig', array(
            'event' => $event
        ));
    }


}
