<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PageType
 */
class PageType extends AbstractType
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
                    'label' => 'page.title',
                    'translation_domain' => 'page',
                )
            )
            ->add(
                'content',
                'ckeditor',
                array(
                    'label' => 'page.content',
                    'translation_domain' => 'page',
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'page.submit',
                    'translation_domain' => 'page',
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
                'data_class' => 'AppBundle\Entity\Page',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'page';
    }
}
