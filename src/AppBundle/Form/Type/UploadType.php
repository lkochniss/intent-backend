<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
                TextType::class,
                array(
                    'required' => false,
                    'label' => 'filemanager.image.name',
                    'translation_domain' => 'filemanager'
                )
            )
            ->add(
                'description',
                TextareaType::class,
                array(
                    'required' => false,
                    'label' => 'filemanager.image.description',
                    'translation_domain' => 'filemanager'
                )
            )
            ->add(
                'file',
                FileType::class,
                array(
                    'required' => false,
                    'multiple' => false,
                    'label' => 'filemanager.select',
                    'translation_domain' => 'filemanager'
                )
            )
            ->add(
                'submit',
                SubmitType::class,
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
        return 'upload';
    }
}
