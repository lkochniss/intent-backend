<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FranchiseType
 */
class FranchiseType extends AbstractType
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
                    'label' => 'franchise.name',
                    'translation_domain' => 'franchise',
                )
            )
            ->add(
                'description',
                'textarea',
                array(
                    'label' => 'franchise.description',
                    'translation_domain' => 'franchise',
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                )
            )
            ->add(
                'publisher',
                'entity',
                array(
                    'label' => 'franchise.publisher',
                    'translation_domain' => 'franchise',
                    'class' => 'AppBundle\Entity\Publisher',
                    'multiple' => false,
                    'expanded' => false
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'franchise.submit',
                    'translation_domain' => 'franchise',
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
                'data_class' => 'AppBundle\Entity\Franchise',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'franchise';
    }
}
