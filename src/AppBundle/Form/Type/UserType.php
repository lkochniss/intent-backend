<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
                TextType::class,
                array(
                    'label' => 'user.name',
                    'translation_domain' => 'user',
                )
            )
            ->add(
                'email',
                EmailType::class,
                array(
                    'label' => 'user.email',
                    'translation_domain' => 'user',
                    'required' => true
                )
            )
            ->add(
                'roles',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Role',
                    'choice_label' => 'name',
                    'label' => 'user.role',
                    'translation_domain' => 'user',
                    'multiple' => 'true'
                )
            )
            ->add(
                'isActive',
                CheckboxType::class,
                array(
                    'label' => 'user.active',
                    'translation_domain' => 'user'
                )
            )
            ->add(
                'submit',
                SubmitType::class,
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
