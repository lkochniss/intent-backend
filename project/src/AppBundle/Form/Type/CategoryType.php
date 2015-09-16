<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CategoryType
 */
class CategoryType extends AbstractType
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
                'text',
                array(
                    'label' => 'category.name',
                    'translation_domain' => 'category',
                )
            )
            ->add(
                'priority',
                'number',
                array(
                    'label' => 'category.priority',
                    'translation_domain' => 'category',
                )
            )
            ->add(
                'save',
                'submit',
                array(
                    'label' => 'category.submit',
                    'translation_domain' => 'category',
                    'attr' => array(
                        'class' => 'btn-primary'
                    )
                )
            )
            ->add(
                'saveAndPublish',
                'submit',
                array(
                    'label' => 'category.publish',
                    'translation_domain' => 'category',
                    'attr' => array(
                        'class' => 'btn-success'
                    )
                )
            );

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add category to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Category',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'category';
    }
}
