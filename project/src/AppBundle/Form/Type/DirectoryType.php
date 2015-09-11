<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DirectoryType
 */
class DirectoryType extends AbstractType
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

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add directory to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Directory',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'directory';
    }
}
