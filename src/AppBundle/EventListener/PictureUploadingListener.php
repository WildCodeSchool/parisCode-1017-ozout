<?php

/**
 * Created by PhpStorm.
 * User: cyrht
 * Date: 01/02/18
 * Time: 17:12
 */

namespace AppBundle\EventListener;

use AppBundle\Service\FileUploader;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

    /**
     * Listener responsible to change
     */
    class PictureUploadingListener implements EventSubscriberInterface
    {
        private $uploader;

        public function __construct(FileUploader $uploader)
        {
            $this->uploader= $uploader;
        }

        /**
         * {@inheritdoc}
         */
        public static function getSubscribedEvents()
        {
            return array(
                FOSUserEvents::REGISTRATION_SUCCESS => 'onPictureUploadingSuccess',
                FOSUserEvents::PROFILE_EDIT_SUCCESS => 'onPictureUploadingSuccess',
            );
        }

        public function onPictureUploadingSuccess(FormEvent $event)
        {
            
            $user = $event->getForm()->getViewData();

            $this->uploader->upload($user->getPicture());

            $event->stopPropagation();
        }

}