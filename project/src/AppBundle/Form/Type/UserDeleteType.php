<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class UserDeleteType
 */
class UserDeleteType extends AbstractType
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
                'checkbox',
                array(
                    'label' => 'user.delete.confirm',
                    'translation_domain' => 'user',
                    'required' => true,
                )
            )
            ->add(
                'user',
                'entity',
                array(
                    'label' => 'user.delete.user',
                    'translation_domain' => 'user',
                    'class' => 'AppBundle\Entity\User',
                    'required' => false,
                    'multiple' => false,
                    'placeholder' => 'user.delete.select'
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'user.delete.submit',
                    'translation_domain' => 'user',
                )
            );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user_delete';
    }
}
