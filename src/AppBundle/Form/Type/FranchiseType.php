<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FranchiseType
 */
class FranchiseType extends AbstractType
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
                    'label' => 'franchise.name',
                    'translation_domain' => 'franchise',
                )
            )
            ->add(
                'description',
                TextareaType::class,
                array(
                    'label' => 'franchise.description',
                    'translation_domain' => 'franchise',
                    'required' => false,
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                )
            )
            ->add(
                'publisher',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Publisher',
                    'choice_label' => 'name',
                    'label' => 'franchise.publisher.name',
                    'translation_domain' => 'franchise'
                )
            )
            ->add(
                'studio',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Studio',
                    'choice_label' => 'name',
                    'label' => 'franchise.studio.name',
                    'translation_domain' => 'franchise'
                )
            )
            ->add(
                'background_image',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Image',
                    'choice_label' => 'name',
                    'label' => 'franchise.backgroundimage.label',
                    'placeholder' => 'franchise.backgroundimage.select',
                    'translation_domain' => 'franchise'
                )
            )
            ->add(
                'thumbnail',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Image',
                    'choice_label' => 'name',
                    'label' => 'franchise.thumbnail.label',
                    'placeholder' => 'franchise.thumbnail.select',
                    'translation_domain' => 'franchise'
                )
            )
            ->add(
                'save',
                SubmitType::class,
                array(
                    'label' => 'franchise.submit',
                    'translation_domain' => 'franchise',
                    'attr' => array(
                        'class' => 'btn-primary'
                    )
                )
            )
            ->add(
                'saveAndPublish',
                SubmitType::class,
                array(
                    'label' => 'franchise.publish',
                    'translation_domain' => 'franchise',
                    'attr' => array(
                        'class' => 'btn-success'
                    )
                )
            );

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add franchise to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Franchise',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'franchise';
    }
}
