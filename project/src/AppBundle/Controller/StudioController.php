<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Studio;
use AppBundle\Form\Type\StudioType;

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
        return new StudioType();
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

    protected function getTranslationDomain()
    {
        return 'studio';
    }

    protected function getReadAccessLevel()
    {
        return 'ROLE_READ_META';
    }

    protected function getWriteAccessLevel()
    {
        return 'ROLE_WRITE_META';
    }

    protected function getPublishAccessLevel()
    {
        return 'ROLE_PUBLISH_META';
    }
}
