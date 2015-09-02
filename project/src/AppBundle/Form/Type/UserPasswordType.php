<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserPasswordType
 * @package AppBundle\Form\Type
 */
class UserPasswordType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'password',
                'repeated',
                array(
                    'type' => 'password',
                    'required' => true,
                    'first_options' => array(
                        'label' => 'user.password.first',
                        'translation_domain' => 'user'
                    ),
                    'second_options' => array(
                        'label' => 'user.password.second',
                        'translation_domain' => 'user'
                    ),
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'user.password.submit',
                    'translation_domain' => 'user',
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
                'data_class' => 'AppBundle\Entity\User',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user_password';
    }
}
