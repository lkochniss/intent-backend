<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FilemanagerType
 */
class FilemanagerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                'text',
                array(
                    'label' => 'filename.directory',
                    'translation_domain' => 'filemanager',
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'filemanager.submit',
                    'translation_domain' => 'filemanager',
                )
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(

            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'filemanager';
    }
}
