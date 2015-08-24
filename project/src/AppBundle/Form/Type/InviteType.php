<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TagType
 */
class InviteType extends AbstractType
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
                'email',
                'email',
                array(
                    'label' => 'user.email',
                    'translation_domain' => 'user',
                    'required' => true
                )
            )
            ->add(
                'roles',
                'entity',
                array(
                    'label' => 'user.role',
                    'translation_domain' => 'user',
                    'class' => 'AppBundle\Entity\Role',
                    'required' => true,
                    'multiple' => true,
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
     * @return string
     */
    public function getName()
    {
        return 'invite';
    }
}
