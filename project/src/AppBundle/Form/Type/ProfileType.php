<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TagType
 */
class ProfileType extends AbstractType
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
                    'label' => 'profile.name',
                    'translation_domain' => 'profile',
                )
            )
            ->add(
                'description',
                'textarea',
                array(
                    'label' => 'profile.description',
                    'translation_domain' => 'profile',
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'profile.submit',
                    'translation_domain' => 'profile',
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
                'data_class' => 'AppBundle\Entity\Profile',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'profile';
    }
}
