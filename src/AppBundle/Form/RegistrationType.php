<?php
/**
 * Created by PhpStorm.
 * User: cyrht
 * Date: 23/01/18
 * Time: 16:23
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder, array $options)

    {
        $builder
            ->add('nameUser')
            ->add('surnameUser')
            ->add('dateOfBirth')
            ->add('picture', PictureType::class, array(
            'label'=> 'votre photo'
        ));
    }

    public function getParent()

    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()

    {
        return 'app_user_registration';
    }

    public function getName()

    {
        return $this->getBlockPrefix();
    }

}