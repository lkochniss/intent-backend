<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ExpansionPublishType
 */
class ExpansionPublishType extends AbstractType
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
                    'label' => 'expansion.publish',
                    'translation_domain' => 'expansion',
                )
            );

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add expansion to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Expansion',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'expansion_publish';
    }
}
