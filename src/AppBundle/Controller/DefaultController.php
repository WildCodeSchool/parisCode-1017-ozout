<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DefaultController extends Controller
{
    /**
     * List all event entities
     *
     * @Route("/", name="homepage")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('AppBundle:Event')->getAllNotPrivateEvent();

        if ($this->getUser() != null){
            $reservations = $em->getRepository(Reservation::class)->getIdEventReservationByUser($this->getUser());
            foreach ($events as $key => $event){
                foreach ($reservations as $reservation){
                    if (in_array($event->getId(), $reservation)){
                        $event->userParticipate = true;
                    }
                }
            }
        }

        $reviews = $em->getRepository('AppBundle:Review')->findBy(
            array(),
            array(),
            3
        );
        return $this->render('default/index.html.twig', array(
            'events' => $events,
            'reviews' => $reviews
        ));
    }

    /**
     * Send to Contact Page
     *
     * @Route("/contact", name="contact")
     * @Method("GET")
     */
    public function contactShowAction()
    {
        return $this->render('default/contact.html.twig');
    }

    /**
     * Send to About Page
     *
     * @Route("/about", name="about")
     * @Method("GET")
     */
    public function aboutShowAction()
    {
        return $this->render('default/about.html.twig');
    }
}
