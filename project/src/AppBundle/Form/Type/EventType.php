<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EventType
 */
class EventType extends AbstractType
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
                    'label' => 'event.name',
                    'translation_domain' => 'event',
                )
            )
            ->add(
                'description',
                'textarea',
                array(
                    'label' => 'event.description',
                    'translation_domain' => 'event',
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                )
            )
            ->add(
                'startAt',
                'date',
                array(
                    'label' => 'event.startAt',
                    'translation_domain' => 'event',
                    'widget' => 'choice',
                )
            )
            ->add(
                'endAt',
                'date',
                array(
                    'label' => 'event.endAt',
                    'translation_domain' => 'event',
                    'widget' => 'choice',
                )
            )
            ->add(
                'background_image',
                'entity',
                array(
                    'label' => 'event.backgroundimage.label',
                    'translation_domain' => 'event',
                    'class' => 'AppBundle\Entity\Image',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'event.backgroundimage.select',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'thumbnail',
                'entity',
                array(
                    'label' => 'event.thumbnail.label',
                    'translation_domain' => 'event',
                    'class' => 'AppBundle\Entity\Image',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'event.thumbnail.select',
                    'empty_data' => null,
                    'required' => false,
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

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add event to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Event',
            )
        );

         return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'event';
    }
}
