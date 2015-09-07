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
                'textarea',
                array(
                    'label' => 'game.description',
                    'translation_domain' => 'game',
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                )
            )
            ->add(
                'studio',
                'entity',
                array(
                    'label' => 'game.studio.name',
                    'translation_domain' => 'game',
                    'class' => 'AppBundle\Entity\Studio',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'game.studio.select',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'franchise',
                'entity',
                array(
                    'label' => 'game.franchise.name',
                    'translation_domain' => 'game',
                    'class' => 'AppBundle\Entity\Franchise',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'game.franchise.select',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'background_image',
                'entity',
                array(
                    'label' => 'game.backgroundimage.label',
                    'translation_domain' => 'game',
                    'class' => 'AppBundle\Entity\Image',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'game.backgroundimage.select',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'thumbnail',
                'entity',
                array(
                    'label' => 'game.thumbnail.label',
                    'translation_domain' => 'game',
                    'class' => 'AppBundle\Entity\Image',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'game.thumbnail.select',
                    'empty_data' => null,
                    'required' => false,
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
