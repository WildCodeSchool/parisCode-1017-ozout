<?php

namespace AppBundle\Form;

use AppBundle\Entity\Picture;
use AppBundle\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            ->add('title')
            ->add('adress')
            ->add('city')
            ->add('zipcode')
            ->add('latitude')
            ->add('longitude')
            ->add('start')
            ->add('targetMoney')
            ->add('deadline')
            ->add('isPrivate')
            ->add('maxPeople')
            ->add('onGoingMoney')
            ->add('picture', PictureType::class, array(
            ))
            ->add('category', EntityType::class, array(
                'class' => Category::class,
                'choice_label' => 'nameCategory',
                'label' => 'Catégorie de l\'event'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event'
        ));
    }

    /**w
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_event';
    }


}
