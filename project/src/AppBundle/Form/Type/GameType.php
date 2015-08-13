<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GameType
 */
class GameType extends AbstractType
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
                    'label' => 'game.name',
                    'translation_domain' => 'game',
                )
            )
            ->add(
                'description',
                'ckeditor',
                array(
                    'label' => 'game.description',
                    'translation_domain' => 'game',
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'game.submit',
                    'translation_domain' => 'game',
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
                'data_class' => 'AppBundle\Entity\Game',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'game';
    }
}
