<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Entity\Reservation;
use AppBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Reservation controller.
 *
 * @Route("reservation")
 */
class ReservationController extends Controller
{
    /**
     * @Route("/create/{id}", name="reservation_create")
     */
    public function createReservationAction(Event $event, Request $request){
        $currentUser = $this->getUser();

        $reservation = new Reservation();
        $reservation->setEvent($event);
        $reservation->setUser($currentUser);
        $reservation->setIsCreator(false);

        $progress = floor($event->getOnGoingMoney() / $event->getTargetMoney() * 100);

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $event->setOnGoingMoney(
                $event->getOnGoingMoney() + $reservation->getMoneyGiven()
            );
            $event->setNbPeopleParticipate(
                $event->getNbPeopleParticipate() + 1
            );

            // TODO: add css to notify if event is valid or not valid
            if ($event->getOnGoingMoney() == $event->getTargetMoney()){
                $event->setIsValid(true);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();

            $this->addFlash('successMsg', "Inscription confirmée");

            /* Send Message */
            $message = (new \Swift_Message())
                ->setSubject('Ton inscription à l\'évènement' . " " . $event->getTitle())
                ->setFrom($this->getParameter('mailer_user'))
                ->setTo($currentUser->getEmail())
                ->setBody(
                    $this->renderView('email/mailNewParticipation.html.twig', array(
                            'event' => $event,
                            'user' => $currentUser,
                            'reservation' => $reservation
                        )
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->render('reservation/new.html.twig', array(
            'reservation' => $reservation,
            'form' => $form->createView(),
            'progress' => $progress
        ));
    }

    /**
     * Deletes a reservation
     * @method ("GET")
     * @param Reservation $reservation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{id}/delete", name="reservation_delete")
     */
    public function deleteReservationAction(Reservation $reservation)
    {
        $em = $this->getDoctrine()->getManager();

        $event= $reservation->getEvent();

        $money= $reservation->getMoneyGiven();

        $event->setOnGoingMoney($event->getOnGoingMoney()-$money);

        $em->remove($reservation);

        $em->flush();

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

        /* Send Message Creator */
        $message = (new \Swift_Message())
            ->setSubject( $reservation->getUser() . " ". 'a annulé sa participation à l\'événement'. $event->getTitle())
            ->setFrom($this->getParameter('mailer_user'))
            ->setTo($creator->getEmail())
            ->setBody(
                $this->renderView('email/mailDeleteReservationCreator.html.twig', array(
                        'event' => $event,
                        'creator' => $creator,

                    )
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);

        if (isset($emails)){

            /* Send Message Participant */
            $message = (new \Swift_Message())
                ->setSubject('Ta participation à l\'événement' . " " . $event->getTitle() . " ". 'a été annulée')
                ->setFrom($this->getParameter('mailer_user'))
                ->setTo($emails)
                ->setBody(
                    $this->renderView('email/mailDeleteReservationParticipant.html.twig', array(
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
}
