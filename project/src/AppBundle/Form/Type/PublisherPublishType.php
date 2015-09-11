<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PublisherPublishType
 */
class PublisherPublishType extends AbstractType
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
                'submit',
                'submit',
                array(
                    'label' => 'publisher.publish',
                    'translation_domain' => 'publisher',
                )
            );

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add publisher to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Publisher',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'publisher_publish';
    }
}
