<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
use AppBundle\Entity\Publisher;
use AppBundle\Form\Type\PublisherType;

/**
 * Class PublisherController
 */
class PublisherController extends AbstractCrudController
{
    /**
     * @return Publisher
     */
    protected function createNewEntity() : AbstractModel
    {
        return new Publisher();
    }

    /**
     * @return string
     */
    protected function getFormType() : string
    {
        return PublisherType::class;
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath() : string
    {
        return 'Publisher';
    }

    /**
     * @return string
     */
    protected function getEntityName() : string
    {
        return 'AppBundle\Entity\Publisher';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix() : string
    {
        return 'intent_backend_publisher';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain() : string
    {
        return 'publisher';
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
