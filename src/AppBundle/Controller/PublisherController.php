<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

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
    protected function createNewEntity()
    {
        return new Publisher();
    }

    /**
     * @return PublisherType
     */
    protected function getFormType()
    {
        return PublisherType::class;
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath()
    {
        return 'Publisher';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'AppBundle\Entity\Publisher';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return 'intent_backend_publisher';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain()
    {
        return 'publisher';
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
