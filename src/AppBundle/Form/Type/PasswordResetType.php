<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class UserPasswordType
 */
class PasswordResetType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder Builder.
     * @param array                $options Option.
     * @return null
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'username',
                TextType::class,
                array(
                    'label' => 'security.username',
                    'translation_domain' => 'security',
                )
            )
            ->add(
                'submit',
                SubmitType::class,
                array(
                    'label' => 'security.reset',
                    'translation_domain' => 'security',
                )
            );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'password_reset';
    }
}
