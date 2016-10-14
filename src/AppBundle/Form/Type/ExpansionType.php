<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ExpansionType
 */
class ExpansionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder Builder.
     * @param array                $options Optopns.
     * @return null
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                array(
                    'label' => 'expansion.name',
                    'translation_domain' => 'expansion',
                )
            )
            ->add(
                'description',
                TextareaType::class,
                array(
                    'label' => 'expansion.description',
                    'translation_domain' => 'expansion',
                    'required' => false,
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                )
            )
            ->add(
                'game',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Game',
                    'choice_label' => 'name',
                    'label' => 'expansion.game.name',
                    'placeholder' => 'expansion.game.select',
                    'translation_domain' => 'expansion'
                )
            )
            ->add(
                'background_image',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Image',
                    'choice_label' => 'name',
                    'label' => 'expansion.backgroundimage.label',
                    'placeholder' => 'expansion.backgroundimage.select',
                    'translation_domain' => 'expansion'
                )
            )
            ->add(
                'thumbnail',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Image',
                    'choice_label' => 'name',
                    'label' => 'expansion.thumbnail.label',
                    'placeholder' => 'expansion.thumbnail.select',
                    'translation_domain' => 'expansion'
                )
            )
            ->add(
                'save',
                SubmitType::class,
                array(
                    'label' => 'expansion.submit',
                    'translation_domain' => 'expansion',
                    'attr' => array(
                        'class' => 'btn-primary'
                    )
                )
            )
            ->add(
                'saveAndPublish',
                SubmitType::class,
                array(
                    'label' => 'expansion.publish',
                    'translation_domain' => 'expansion',
                    'attr' => array(
                        'class' => 'btn-success'
                    )
                )
            );

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add expansion to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Expansion',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'expansion';
    }
}
