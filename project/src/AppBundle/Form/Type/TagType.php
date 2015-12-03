<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TagType
 */
class TagType extends AbstractType
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
                    'label' => 'tag.name',
                    'translation_domain' => 'tag',
                )
            )
            ->add(
                'save',
                'submit',
                array(
                    'label' => 'tag.submit',
                    'translation_domain' => 'tag',
                    'attr' => array(
                        'class' => 'btn-primary'
                    )
                )
            )
            ->add(
                'saveAndPublish',
                'submit',
                array(
                    'label' => 'tag.publish',
                    'translation_domain' => 'tag',
                    'attr' => array(
                        'class' => 'btn-success'
                    )
                )
            );

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add tag to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Tag',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tag';
    }
}
