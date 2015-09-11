<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UploadType
 */
class UploadType extends AbstractType
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
                    'required' => false,
                    'label' => 'filemanager.image.name',
                    'translation_domain' => 'filemanager'
                )
            )
            ->add(
                'description',
                'textarea',
                array(
                    'required' => false,
                    'label' => 'filemanager.image.description',
                    'translation_domain' => 'filemanager'
                )
            )
            ->add(
                'file',
                'file',
                array(
                    'required' => false,
                    'multiple' => false,
                    'label' => 'filemanager.select',
                    'translation_domain' => 'filemanager'
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'filemanager.upload',
                    'translation_domain' => 'filemanager',
                )
            );

        return null;
    }

    /**
     * @param OptionsResolver $resolver Adds image to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Image',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'uplpad';
    }
}
