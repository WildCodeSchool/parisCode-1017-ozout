<?php
/**
 * Created by PhpStorm.
 * User: nam
 * Date: 24/01/2018
 * Time: 15:25
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Category controller.
 *
 * @Route("home")
 */
class HomePageController extends Controller
{
    /**
     * Home page connected
     *
     * @Route("/", name="home_connected")
     * @Method("GET")
     */
    public function showHomePageAction() {
        $em = $this->getDoctrine()->getManager();
        $eventsCreator = $em->getRepository('AppBundle:Event')->getEventByUserCreator($this->getUser());
        $eventsParticipate = $em->getRepository('AppBundle:Event')->getEventByUserParticipate($this->getUser());

        // replace this example code with whatever you need
        return $this->render(
            'user/home/index.html.twig', [
                'eventsCreator' =>$eventsCreator,
                'eventsParticipate' =>$eventsParticipate,
            ]
        );

    }
}