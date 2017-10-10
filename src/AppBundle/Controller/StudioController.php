<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
use AppBundle\Entity\Studio;
use AppBundle\Form\Type\StudioType;

/**
 * Class StudioController
 */
class StudioController extends AbstractCrudController
{
    /**
     * @return Studio
     */
    protected function createNewEntity() : AbstractModel
    {
        return new Studio();
    }

    /**
     * @return string
     */
    protected function getFormType() : string
    {
        return StudioType::class;
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath() : string
    {
        return 'Studio';
    }

    /**
     * @return string
     */
    protected function getEntityName() : string
    {
        return 'AppBundle\Entity\Studio';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix() : string
    {
        return 'intent_backend_studio';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain() : string
    {
        return 'studio';
    }

    /**
     * @return string
     */
    protected function getReadAccessLevel() : string
    {
        return 'ROLE_READ_META';
    }

    /**
     * @return string
     */
    protected function getWriteAccessLevel() : string
    {
        return 'ROLE_WRITE_META';
    }

    /**
     * @return string
     */
    protected function getPublishAccessLevel() : string
    {
        return 'ROLE_PUBLISH_META';
    }
}
