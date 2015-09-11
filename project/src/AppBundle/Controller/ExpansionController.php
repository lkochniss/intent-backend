<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Expansion;
use AppBundle\Form\Type\ExpansionPublishType;
use AppBundle\Form\Type\ExpansionType;

/**
 * Class ExpansionController
 */
class ExpansionController extends AbstractRelatedController
{
    /**
     * @return Expansion
     */
    protected function createNewEntity()
    {
        return new Expansion();
    }

    /**
     * @return ExpansionType
     */
    protected function getFormType()
    {
        return new ExpansionType();
    }

    /**
     * @return ExpansionPublishType
     */
    protected function getPublishType()
    {
        return new ExpansionPublishType();
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath()
    {
        return 'Expansion';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'AppBundle\Entity\Expansion';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return 'intent_backend_expansion';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain()
    {
        return 'expansion';
    }

    /**
     * @return string
     */
    protected function getReadAccessLevel()
    {
        return 'ROLE_READ_META';
    }

    /**
     * @return string
     */
    protected function getWriteAccessLevel()
    {
        return 'ROLE_WRITE_META';
    }

    /**
     * @return string
     */
    protected function getPublishAccessLevel()
    {
        return 'ROLE_PUBLISH_META';
    }
}
