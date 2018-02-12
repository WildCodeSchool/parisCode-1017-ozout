<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Reservation;
use AppBundle\Entity\User;
use AppBundle\Form\SearchType;
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
        $events = $em->getRepository('AppBundle:Event')->getAllNotPrivateEvent($this->getUser(), 9);

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

        $reviews = $em->getRepository('AppBundle:Review')->findBy(
            array(),
            array(),
            3
        );
        return $this->render('default/index.html.twig', array(
            'events' => $events,
            'reviews' => $reviews,
            'formSearch' => $form->createView()
        ));
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

    /**
     * Send to CGV Page
     *
     * @Route("/cgv", name="cgv")
     * @Method("GET")
     */
    public function cgvShowAction()
    {
        return $this->render('default/cgv.html.twig');
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}/user/delete", name="user_delete")
     * @Method("GET")
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(User $user )
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush($user);

        return $this->redirectToRoute('homepage');
    }


}
