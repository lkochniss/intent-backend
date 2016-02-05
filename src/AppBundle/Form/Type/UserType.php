<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserType
 */
class UserType extends AbstractType
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
                    'class' => 'AppBundle\Entity\Role',
                    'required' => true,
                    'multiple' => true,
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

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add user entity to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\User',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user';
    }
}
