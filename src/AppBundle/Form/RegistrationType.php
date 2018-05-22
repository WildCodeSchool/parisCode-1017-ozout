<?php
/**
 * Created by PhpStorm.
 * User: cyrht
 * Date: 23/01/18
 * Time: 16:23
 */

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder, array $options)

    {
        $builder
            ->add('nameUser',TextType::class, array(
                'label' =>'Prénom'
            ))
            ->add('surnameUser',TextType::class, array(
                'label' => 'Nom'
            ))
            ->add('dateOfBirth',BirthdayType::class, array(
                'label' => 'Date de naissance'
            ))
            ->add('picture', PictureType::class, array(
            'label'=> 'Ta photo',
            ))
        ;
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