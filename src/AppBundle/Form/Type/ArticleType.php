<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ArticleType
 */
class ArticleType extends AbstractType
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
                'title',
                TextType::class,
                array(
                    'label' => 'article.title',
                    'translation_domain' => 'article',
                )
            )
            ->add(
                'content',
                TextareaType::class,
                array(
                    'label' => 'article.content',
                    'translation_domain' => 'article',
                    'required' => false,
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                )
            )
            ->add(
                'slideshow',
                CheckboxType::class,
                array(
                    'label' => 'article.slideshow',
                    'translation_domain' => 'article',
                    'required' => false
                )
            )
            ->add(
                'category',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Category',
                    'choice_label' => 'name',
                    'label' => 'article.category.label',
                    'placeholder' => 'article.category.select',
                    'translation_domain' => 'article'
                )
            )
            ->add(
                'related',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Related',
                    'choice_label' => 'name',
                    'label' => 'article.related.label',
                    'translation_domain' => 'article'
                )
            )
            ->add(
                'event',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Event',
                    'choice_label' => 'name',
                    'label' => 'article.event.label',
                    'placeholder' => 'article.event.select',
                    'translation_domain' => 'article'
                )
            )
            ->add(
                'tags',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Tag',
                    'choice_label' => 'name',
                    'label' => 'article.tag.label',
                    'placeholder' => 'article.tag.select',
                    'translation_domain' => 'article',
                    'multiple' => 'true'
                )
            )
            ->add(
                'thumbnail',
                EntityType::class,
                array(
                    'class' => 'AppBundle:Image',
                    'choice_label' => 'name',
                    'label' => 'article.thumbnail.label',
                    'placeholder' => 'article.thumbnail.select',
                    'translation_domain' => 'article'
                )
            )
            ->add(
                'publishAt',
                DateTimeType::class,
                array(
                    'label' => 'article.published.at',
                    'translation_domain' => 'article',
                )
            )
            ->add(
                'save',
                SubmitType::class,
                array(
                    'label' => 'article.submit',
                    'translation_domain' => 'article',
                    'attr' => array(
                        'class' => 'btn-primary'
                    )
                )
            )
            ->add(
                'saveAndPublish',
                SubmitType::class,
                array(
                    'label' => 'article.publish',
                    'translation_domain' => 'article',
                    'attr' => array(
                        'class' => 'btn-success'
                    )
                )
            );

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add article to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Article',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'article';
    }
}
