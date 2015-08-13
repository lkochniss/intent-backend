<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PublisherType
 */
class PublisherType extends AbstractType
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
                    'label' => 'publisher.name',
                    'translation_domain' => 'publisher',
                )
            )
            ->add(
                'description',
                'ckeditor',
                array(
                    'label' => 'publisher.description',
                    'translation_domain' => 'publisher',
                )
            )
            ->add(
                'franchises',
                'entity',
                array(
                    'label' => 'publisher.franchise',
                    'translation_domain' => 'publisher',
                    'class' => 'AppBundle\Entity\Franchise',
                    'multiple' => true,
                    'expanded' => true
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'publisher.submit',
                    'translation_domain' => 'publisher',
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
                'data_class' => 'AppBundle\Entity\Publisher',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'publisher';
    }
}
