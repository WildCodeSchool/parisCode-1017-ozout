<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Entity\Reservation;
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

        $events = $em->getRepository('AppBundle:Event')->findAll();

        return $this->render(
            'event/index.html.twig', array(
            'events' => $events,
            'events_json' => json_encode($events)
            )
        );
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

            return $this->redirectToRoute('event_show', array('id' => $event->getId()));
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

            return $this->redirectToRoute('event_edit', array('id' => $event->getId()));
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
     * @Route("/delete/{id}", name="event_delete")
     * @Method("GET")
     */
    public function deleteAction(Event $event, FileUploader $fileUploader)
    {

            $em = $this->getDoctrine()->getManager();

            $em->remove($event);

            $fileUploader->remove($event->getPicture());

            $em->flush();

        return $this->redirectToRoute('event_index');
    }


}
