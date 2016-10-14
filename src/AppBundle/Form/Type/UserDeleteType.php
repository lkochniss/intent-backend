<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
                EntityType::class,
                array(
                    'class' => 'AppBundle:User',
                    'choice_label' => 'username',
                    'label' => 'user.delete.user',
                    'placeholder' => 'user.delete.select',
                    'translation_domain' => 'user'
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
