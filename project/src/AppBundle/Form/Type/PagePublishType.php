<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PagePublishType
 */
class PagePublishType extends AbstractType
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
                    'label' => 'page.published.at',
                    'translation_domain' => 'page',
                )
            )
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'page.publish',
                    'translation_domain' => 'page',
                )
            );

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add page to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Page',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'page_publish';
    }
}
