<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ExpansionType
 */
class ExpansionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder Builder.
     * @param array                $options Optopns.
     * @return null
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                'text',
                array(
                    'label' => 'expansion.name',
                    'translation_domain' => 'expansion',
                )
            )
            ->add(
                'description',
                'textarea',
                array(
                    'label' => 'expansion.description',
                    'translation_domain' => 'expansion',
                    'required' => false,
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                )
            )
            ->add(
                'game',
                'entity',
                array(
                    'label' => 'expansion.game.name',
                    'translation_domain' => 'expansion',
                    'class' => 'AppBundle\Entity\Game',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'expansion.game.select',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'background_image',
                'entity',
                array(
                    'label' => 'expansion.backgroundimage.label',
                    'translation_domain' => 'expansion',
                    'class' => 'AppBundle\Entity\Image',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'expansion.backgroundimage.select',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'thumbnail',
                'entity',
                array(
                    'label' => 'expansion.thumbnail.label',
                    'translation_domain' => 'expansion',
                    'class' => 'AppBundle\Entity\Image',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'expansion.thumbnail.select',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'save',
                'submit',
                array(
                    'label' => 'expansion.submit',
                    'translation_domain' => 'expansion',
                    'attr' => array(
                        'class' => 'btn-primary'
                    )
                )
            )
            ->add(
                'saveAndPublish',
                'submit',
                array(
                    'label' => 'expansion.publish',
                    'translation_domain' => 'expansion',
                    'attr' => array(
                        'class' => 'btn-success'
                    )
                )
            );

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add expansion to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Expansion',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'expansion';
    }
}
