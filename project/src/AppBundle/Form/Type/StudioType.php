<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class StudioType
 */
class StudioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                'text',
                array(
                    'label' => 'studio.name',
                    'translation_domain' => 'studio',
                )
            )
            ->add(
                'description',
                'ckeditor',
                array(
                    'label' => 'studio.description',
                    'translation_domain' => 'studio',
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'studio.submit',
                    'translation_domain' => 'studio',
                )
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Studio',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'studio';
    }
}
