<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Publisher;
use AppBundle\Form\Type\PublisherPublishType;
use AppBundle\Form\Type\PublisherType;

class PublisherController extends AbstractRelatedController
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
        return new PublisherType();
    }

    /**
     * @return PublisherPublishType
     */
    protected function getPublishType()
    {
        return new PublisherPublishType();
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

    protected function getTranslationDomain()
    {
        return 'publisher';
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
