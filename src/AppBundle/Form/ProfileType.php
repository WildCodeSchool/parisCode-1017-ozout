<?php
/**
 * Created by PhpStorm.
 * User: cyrht
 * Date: 01/02/18
 * Time: 14:42
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class ProfileType extends AbstractType
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
                'label'=> 'Votre photo',
            ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()

    {
        return 'app_user_profile';
    }

    public function getName()

    {
        return $this->getBlockPrefix();
    }
}