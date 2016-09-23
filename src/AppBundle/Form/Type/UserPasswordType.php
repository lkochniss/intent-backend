<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserPasswordType
 */
class UserPasswordType extends AbstractType
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
                'password',
                RepeatedType::class,
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
                SubmitType::class,
                array(
                    'label' => 'user.password.submit',
                    'translation_domain' => 'user',
                )
            );

        return null;
    }

    /**
     * @param OptionsResolver $resolver Load user in form.
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
        return 'user_password';
    }
}
