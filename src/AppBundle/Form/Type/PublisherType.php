<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
                TextType::class,
                array(
                    'label' => 'publisher.name',
                    'translation_domain' => 'publisher',
                )
            )
            ->add(
                'description',
                TextareaType::class,
                array(
                    'label' => 'publisher.description',
                    'translation_domain' => 'publisher',
                    'required' => false,
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                )
            )
            ->add(
                'background_image',
                UploadType::class,
                array(
                    'label' => 'publisher.backgroundimage.label',
                    'translation_domain' => 'publisher',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'thumbnail',
                UploadType::class,
                array(
                    'label' => 'publisher.thumbnail.label',
                    'translation_domain' => 'publisher',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'save',
                SubmitType::class,
                array(
                    'label' => 'publisher.submit',
                    'translation_domain' => 'publisher',
                    'attr' => array(
                        'class' => 'btn-primary'
                    )
                )
            )
            ->add(
                'saveAndPublish',
                SubmitType::class,
                array(
                    'label' => 'publisher.publish',
                    'translation_domain' => 'publisher',
                    'attr' => array(
                        'class' => 'btn-success'
                    )
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
