<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TagType
 */
class UserType extends AbstractType
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
                    'label' => 'user.name',
                    'translation_domain' => 'user',
                )
            )
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
                'email',
                'email',
                array(
                    'label' => 'user.email',
                    'translation_domain' => 'user',
                    'required' => true
                )
            )
            ->add(
                'role',
                'entity',
                array(
                    'class' => 'AppBundle\Entity\Role',
                    'required' => true,
                )
            )
            ->add(
                'isActive',
                'checkbox',
                array(
                    'label' => 'user.active',
                    'translation_domain' => 'user'
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'user.submit',
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
        return 'user';
    }
}
