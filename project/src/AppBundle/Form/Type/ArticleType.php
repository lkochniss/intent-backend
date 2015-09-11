<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
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
                'text',
                array(
                    'label' => 'article.title',
                    'translation_domain' => 'article',
                )
            )
            ->add(
                'content',
                'textarea',
                array(
                    'label' => 'article.content',
                    'translation_domain' => 'article',
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced'
                    )
                )
            )
            ->add(
                'slideshow',
                'checkbox',
                array(
                    'label' => 'article.slideshow',
                    'translation_domain' => 'article',
                    'required' => false
                )
            )
            ->add(
                'category',
                'entity',
                array(
                    'label' => 'article.category.label',
                    'translation_domain' => 'article',
                    'class' => 'AppBundle\Entity\Category',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'article.category.select',
                    'empty_data' => null
                )
            )
            ->add(
                'related',
                'entity',
                array(
                    'label' => 'article.related.label',
                    'translation_domain' => 'article',
                    'class' => 'AppBundle\Entity\Related',
                    'placeholder' => 'article.related.select',
                    'empty_data' => null
                )
            )
            ->add(
                'event',
                'entity',
                array(
                    'label' => 'article.event.label',
                    'translation_domain' => 'article',
                    'class' => 'AppBundle\Entity\Event',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'article.event.select',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'thumbnail',
                'entity',
                array(
                    'label' => 'article.thumbnail.label',
                    'translation_domain' => 'article',
                    'class' => 'AppBundle\Entity\Image',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => 'article.thumbnail.select',
                    'empty_data' => null,
                    'required' => false,
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'article.submit',
                    'translation_domain' => 'article',
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
