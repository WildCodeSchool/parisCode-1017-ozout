<?php

namespace AppBundle\Form;

use AppBundle\Entity\Picture;
use AppBundle\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title', TextType::class, array(
                'label' => 'Nom de l\'événement'
                )
            )
            ->add(
                'start', DateTimeType::class, array(
                    'label' => 'Date de l\'évènement'
                )
            )
            ->add(
                'category', EntityType::class, array(
                'class' => Category::class,
                'choice_label' => 'nameCategory',
                'label' => 'Choisir une catégorie'
                )
            )
            ->add(
                'eventDescription', TextareaType::class, array(
                'label' => 'Description'
                )
            )
            ->add(
                'adress', TextType::class, array(
                'label' => 'Adresse'
                )
            )
            ->add(
                'zipcode', IntegerType::class, array(
                    'label' => 'Code Postal'
                )
            )
            ->add(
                'city', TextType::class, array(
                'label' => 'Ville'
                )
            )
            ->add(
                'targetMoney', MoneyType::class, array(
                'label' => ' Montant de la cagnotte à atteindre'
                )
            )
            ->add(
                'deadline', DateTimeType::class, array(
                    'label' => 'Date limite de participation à la cagnotte'
                )
            )
            ->add(
                'isPrivate', CheckboxType::class, array(
                'label' => 'L\'événement est privé',
                'mapped' => true,
                'required' => false
                )
            )
            ->add(
                'maxPeople', IntegerType::class, array(
                'label' => 'Participants (max.)'
                )
            )
            ->add(
                'picture', PictureType::class, array(
                    'label' => 'Image'
                )
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
            'data_class' => 'AppBundle\Entity\Event'
            )
        );
    }

    /**
     * w
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_event';
    }
    
}
