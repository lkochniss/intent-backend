<?php

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
     * @param FormBuilderInterface $builder
     * @param array $options
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
                'ckeditor',
                array(
                    'label' => 'article.content',
                    'translation_domain' => 'article',
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
                'submit',
                'submit',
                array(
                    'label' => 'article.submit',
                    'translation_domain' => 'article',
                )
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Article',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'article';
    }
}