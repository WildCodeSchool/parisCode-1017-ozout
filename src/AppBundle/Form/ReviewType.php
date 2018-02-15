<?php

namespace AppBundle\Form;

use AppBundle\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ReviewType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'event', EntityType::class, array(
                    'class' => Event::class,
                    'choice_label' => 'title',
                    'label' => 'A quel événement correspond ton avis ?'
                )
            )
            ->add(
                'score', HiddenType::class, array(
                'label' => 'Sur une échelle de 1 à 5, quelle note donnes-tu à l\'événement ?'
                )
            )
            ->add(
                'comment', TextareaType::class, array(
                'label' => 'Dis-nous en plus'
                )
            )
            ->add('user') ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
            'data_class' => 'AppBundle\Entity\Review'
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_review';
    }


}
