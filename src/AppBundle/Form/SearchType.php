<?php

namespace AppBundle\Form;

use AppBundle\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('location', TextType::class, array(
                'required' => false,
                'attr' => array(
                    'placeholder' => "Saississez un lieu"
                )
            ))
            ->add('dateEnd', DateType::class, array(
                'widget' => 'single_text',
                'years' => range(date('Y'), date('Y')+10),
                'months' => range(date('m'), 12),
                'days' => range(date('d'), 31),
                'placeholder' => "Choississez une date"

            ))
            ->add('submit', SubmitType::class, array(
                'label' => "Rechercher les évènements"
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => null
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_search_event';
    }


}
