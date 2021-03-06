<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProfileType
 */
class ProfileType extends AbstractType
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
                'name',
                TextType::class,
                array(
                    'label' => 'profile.name',
                    'translation_domain' => 'profile',
                )
            )
            ->add(
                'description',
                TextareaType::class,
                array(
                    'label' => 'profile.description',
                    'translation_domain' => 'profile',
                    'required' => false,
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                )
            )
            ->add(
                'submit',
                SubmitType::class,
                array(
                    'label' => 'profile.submit',
                    'translation_domain' => 'profile',
                )
            );

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add profile to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Profile',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'profile';
    }
}
