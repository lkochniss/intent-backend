<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserPasswordType
 * @package AppBundle\Form\Type
 */
class PasswordResetType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'username',
                'text',
                array(
                    'label' => 'security.username',
                    'translation_domain' => 'security',
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'security.reset',
                    'translation_domain' => 'security',
                )
            );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'password_reset';
    }
}
