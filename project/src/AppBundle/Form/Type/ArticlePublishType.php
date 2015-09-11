<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ArticlePublishType
 */
class ArticlePublishType extends AbstractType
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
                'publishAt',
                'datetime',
                array(
                    'label' => 'article.published.at',
                    'translation_domain' => 'article',
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'article.publish',
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
        return 'article_publish';
    }
}
