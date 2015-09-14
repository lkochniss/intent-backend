<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EventPublishType
 */
class EventPublishType extends AbstractType
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
                    'label' => 'event.publish',
                    'translation_domain' => 'event',
                )
            );

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add event to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Event',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'event_publish';
    }
}
