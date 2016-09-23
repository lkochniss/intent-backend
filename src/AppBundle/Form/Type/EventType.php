<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
                TextType::class,
                array(
                    'label' => 'event.name',
                    'translation_domain' => 'event',
                )
            )
            ->add(
                'description',
                TextareaType::class,
                array(
                    'label' => 'event.description',
                    'translation_domain' => 'event',
                    'required' => false,
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                )
            )
            ->add(
                'startAt',
                DateTimeType::class,
                array(
                    'label' => 'event.startAt',
                    'translation_domain' => 'event',
                    'widget' => 'choice',
                )
            )
            ->add(
                'endAt',
                DateTimeType::class,
                array(
                    'label' => 'event.endAt',
                    'translation_domain' => 'event',
                    'widget' => 'choice',
                )
            )
            ->add(
                'background_image',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Image',
                    'choice_label' => 'name',
                    'label' => 'event.backgroundimage.label',
                    'placeholder' => 'event.backgroundimage.select',
                    'translation_domain' => 'event'
                )
            )
            ->add(
                'thumbnail',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Image',
                    'choice_label' => 'name',
                    'label' => 'event.thumbnail.label',
                    'placeholder' => 'event.thumbnail.select',
                    'translation_domain' => 'event'
                )
            )
            ->add(
                'save',
                SubmitType::class,
                array(
                    'label' => 'event.submit',
                    'translation_domain' => 'event',
                    'attr' => array(
                        'class' => 'btn-primary'
                    )
                )
            )
            ->add(
                'saveAndPublish',
                SubmitType::class,
                array(
                    'label' => 'event.publish',
                    'translation_domain' => 'event',
                    'attr' => array(
                        'class' => 'btn-success'
                    )
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
