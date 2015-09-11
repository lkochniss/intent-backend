<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
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
                'text',
                array(
                    'label' => 'franchise.name',
                    'translation_domain' => 'franchise',
                )
            )
            ->add(
                'description',
                'textarea',
                array(
                    'label' => 'franchise.description',
                    'translation_domain' => 'franchise',
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                )
            )
            ->add(
                'publisher',
                'entity',
                array(
                    'label' => 'franchise.publisher.name',
                    'translation_domain' => 'franchise',
                    'class' => 'AppBundle\Entity\Publisher',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'franchise.publisher.select',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'studio',
                'entity',
                array(
                    'label' => 'franchise.studio.name',
                    'translation_domain' => 'franchise',
                    'class' => 'AppBundle\Entity\Studio',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'franchise.studio.select',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'background_image',
                'entity',
                array(
                    'label' => 'franchise.backgroundimage.label',
                    'translation_domain' => 'franchise',
                    'class' => 'AppBundle\Entity\Image',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'franchise.backgroundimage.select',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'thumbnail',
                'entity',
                array(
                    'label' => 'franchise.thumbnail.label',
                    'translation_domain' => 'franchise',
                    'class' => 'AppBundle\Entity\Image',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'franchise.thumbnail.select',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'franchise.submit',
                    'translation_domain' => 'franchise',
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
