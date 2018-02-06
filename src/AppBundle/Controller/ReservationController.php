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

            // TODO: add css to notify if event is valid or not valid
            if ($event->getOnGoingMoney() == $event->getTargetMoney()){
                $event->setIsValid(true);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();

            $this->addFlash('successMsg', "Inscription confirmée");

            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->render('reservation/new.html.twig', array(
            'reservation' => $reservation,
            'form' => $form->createView(),
            'progress' => $progress
        ));
    }
}
