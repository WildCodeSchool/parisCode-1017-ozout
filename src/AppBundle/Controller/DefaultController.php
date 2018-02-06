<?php

namespace AppBundle\Controller;

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
        $reviews = $em->getRepository('AppBundle:Review')->findAll();

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
