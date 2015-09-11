<?php
/**
 * @package AppBundle\Form\Type
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FranchisePublishType
 */
class FranchisePublishType extends AbstractType
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
                    'label' => 'franchise.publish',
                    'translation_domain' => 'franchise',
                )
            );

        return null;
    }

    /**
     * @param OptionsResolver $resolver Add franchise to form.
     * @return null
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Franchise',
            )
        );

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'franchise_publish';
    }
}
