<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Studio;
use AppBundle\Form\Type\StudioType;

/**
 * Class StudioController
 */
class StudioController extends AbstractRelatedController
{
    /**
     * @return Studio
     */
    protected function createNewEntity()
    {
        return new Studio();
    }

    /**
     * @return StudioType
     */
    protected function getFormType()
    {
        return StudioType::class;
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath()
    {
        return 'Studio';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'AppBundle\Entity\Studio';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return 'intent_backend_studio';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain()
    {
        return 'studio';
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
