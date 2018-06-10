<?php
// src/Acme/UserBundle/AcmeUserBundle.php

namespace Acme\UserBundle;

use FOS\UserBundle\FOSUserBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use AppBundle\Entity\Event;
use AppBundle\Entity\Reservation;
use AppBundle\Entity\User;

class ProfileController extends FOSUserBundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }

    public function showAction(User $user, Reservation $reservation)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em = $this->getDoctrine()->getManager();
        $plop = $em->getRepository('AppBundle:Event')->getUserCreator($this->getUser());
        $form = $this->createForm(SearchType::class, null, array(
            'action' => $this->generateUrl('result_search'),
            'method' => "post",
            'attr' => array(
                'id' => "searchFormEvent",
            )
        ));
        return $this->render('@FOSUser/Profile/show.html.twig', array(
            'user' => $user,
        ));
    }
}