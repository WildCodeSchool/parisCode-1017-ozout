<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PictureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('namePicture', TextType::class, array(
                'label'=>'Nom de l\'image',
            ))*/
            ->add(
                'pictureUpload', FileType::class, array(
                'label'=> '(formats jpg, gif, png uniquement)'
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
            'data_class' => 'AppBundle\Entity\Picture'
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_picture';
    }


}
