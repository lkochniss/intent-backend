<?php
/**
 * @package AppBundle\Form\Type
 */

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
     * @param FormBuilderInterface $builder Builder.
     * @param array                $options Options.
     * @return null
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
                'textarea',
                array(
                    'label' => 'studio.description',
                    'translation_domain' => 'studio',
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced',
                    ),
                )
            )
            ->add(
                'background_image',
                'entity',
                array(
                    'label' => 'studio.backgroundimage.label',
                    'translation_domain' => 'studio',
                    'class' => 'AppBundle\Entity\Image',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'studio.backgroundimage.select',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'thumbnail',
                'entity',
                array(
                    'label' => 'studio.thumbnail.label',
                    'translation_domain' => 'studio',
                    'class' => 'AppBundle\Entity\Image',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'studio.thumbnail.select',
                    'empty_data' => null,
                    'required' => false,
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

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add studio to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Studio',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'studio';
    }
}
