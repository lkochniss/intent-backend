<?php
/**
 * @package AppBundle\Form\Type
 */

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
                    'label' => 'publisher.name',
                    'translation_domain' => 'publisher',
                )
            )
            ->add(
                'description',
                'textarea',
                array(
                    'label' => 'publisher.description',
                    'translation_domain' => 'publisher',
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                )
            )
            ->add(
                'background_image',
                'entity',
                array(
                    'label' => 'publisher.backgroundimage.label',
                    'translation_domain' => 'publisher',
                    'class' => 'AppBundle\Entity\Image',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'publisher.backgroundimage.select',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'thumbnail',
                'entity',
                array(
                    'label' => 'publisher.thumbnail.label',
                    'translation_domain' => 'publisher',
                    'class' => 'AppBundle\Entity\Image',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'publisher.thumbnail.select',
                    'empty_data' => null,
                    'required' => false,
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

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add publisher to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Publisher',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'publisher';
    }
}
