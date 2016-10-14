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
 * Class GameType
 */
class GameType extends AbstractType
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
                    'label' => 'game.name',
                    'translation_domain' => 'game',
                )
            )
            ->add(
                'description',
                TextareaType::class,
                array(
                    'label' => 'game.description',
                    'translation_domain' => 'game',
                    'required' => false,
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                )
            )
            ->add(
                'studio',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Studio',
                    'choice_label' => 'name',
                    'label' => 'game.studio.name',
                    'placeholder' => 'game.studio.select',
                    'translation_domain' => 'game'
                )
            )
            ->add(
                'franchise',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Franchise',
                    'choice_label' => 'name',
                    'label' => 'game.franchise.name',
                    'placeholder' => 'game.franchise.select',
                    'translation_domain' => 'game'
                )
            )
            ->add(
                'background_image',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Image',
                    'choice_label' => 'name',
                    'label' => 'game.backgroundimage.label',
                    'placeholder' => 'game.backgroundimage.select',
                    'translation_domain' => 'game'
                )
            )
            ->add(
                'thumbnail',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Image',
                    'choice_label' => 'name',
                    'label' => 'game.thumbnail.label',
                    'placeholder' => 'game.thumbnail.select',
                    'translation_domain' => 'game'
                )
            )
            ->add(
                'save',
                SubmitType::class,
                array(
                    'label' => 'game.submit',
                    'translation_domain' => 'game',
                    'attr' => array(
                        'class' => 'btn-primary'
                    )
                )
            )
            ->add(
                'saveAndPublish',
                SubmitType::class,
                array(
                    'label' => 'game.publish',
                    'translation_domain' => 'game',
                    'attr' => array(
                        'class' => 'btn-success'
                    )
                )
            );

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add game to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Game',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'game';
    }
}
