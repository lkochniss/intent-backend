<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GameType
 */
class EventType extends AbstractType
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
                    'label' => 'event.name',
                    'translation_domain' => 'event',
                )
            )
            ->add(
                'description',
                'ckeditor',
                array(
                    'label' => 'event.description',
                    'translation_domain' => 'event',
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'event.submit',
                    'translation_domain' => 'event',
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
                'data_class' => 'AppBundle\Entity\Event',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'event';
    }
}