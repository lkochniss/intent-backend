<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                CheckboxType::class,
                array(
                    'label' => 'user.delete.confirm',
                    'translation_domain' => 'user',
                    'required' => true,
                )
            )
            ->add(
                'user',
                UserType::class,
                array(
                    'label' => 'user.delete.user',
                    'translation_domain' => 'user',
                    'choices' => $options['users']
                )
            )
            ->add(
                'submit',
                SubmitType::class,
                array(
                    'label' => 'user.delete.submit',
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
                'users' => null,
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
