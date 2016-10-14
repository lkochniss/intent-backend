<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class DeleteType
 */
class DeleteType extends AbstractType
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
                'confirm',
                CheckboxType::class,
                array(
                    'label' => 'delete.confirm',
                    'translation_domain' => 'delete',
                )
            )
            ->add(
                'submit',
                SubmitType::class,
                array(
                    'label' => 'delete.submit',
                    'translation_domain' => 'delete',
                )
            );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'delete';
    }
}
