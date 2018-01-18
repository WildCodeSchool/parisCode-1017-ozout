<?php

namespace AppBundle\Form;

use AppBundle\Entity\Picture;
use AppBundle\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
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
            ->add('title', TextType::class, array(
                'label' => 'Nom de l\'événement'
            ))
            ->add('category', EntityType::class, array(
                'class' => Category::class,
                'choice_label' => 'nameCategory',
                'label' => 'Catégorie '
            ))
            ->add('eventDescription', TextType::class, array(
                'label' => 'Description'
            ))
            ->add('adress', TextType::class, array(
                'label' => 'Adresse'
            ))
            ->add('city', TextType::class, array(
                'label' => 'Ville'
            ))
            ->add('zipcode', \Symfony\Component\Form\Extension\Core\Type\IntegerType::class, array(
                'label' => 'Code Postal'
            ))
            ->add('targetMoney', MoneyType::class, array(
                'label' => ' Montant de la cagnotte à atteindre'
            ))
            ->add('deadline', DateTimeType::class, array(
                'label' => 'Date limite de participation'
            ))
            ->add('isPrivate', CheckboxType::class, array(
                'label' => 'l\'événement est privé',
                'mapped' => false,
                'required' => false
            ))
            ->add('maxPeople', IntegerType::class, array(
                'label' => 'Participants (max.)'
            ))
            ->add('picture', PictureType::class, array(
                    'label' => 'Image'
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
