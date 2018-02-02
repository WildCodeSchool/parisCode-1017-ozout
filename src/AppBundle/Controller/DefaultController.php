<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


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
        $events = $em->getRepository('AppBundle:Event')->findBy(array('isPrivate' => false));

        return $this->render(
            'user/default/index.html.twig', [
            'events' =>$events,
            ]
        );
    }

    /**
     * Send to Contact Page
     *
     * @Route("/contact", name="contact")
     * @Method("GET")
     */
    public function contactShowAction()
    {
        return $this->render('user/default/contact.html.twig');
    }
}
