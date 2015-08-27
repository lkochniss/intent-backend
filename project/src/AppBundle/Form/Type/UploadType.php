<?php

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
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add(
                'uploadedFile',
                'file',
                array(
                    'required' => false,
                    'multiple' => true,
                    'label' => 'filemanager.select',
                    'translation_domain' => 'filemanager'
                )
            );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'uplpad';
    }
}
