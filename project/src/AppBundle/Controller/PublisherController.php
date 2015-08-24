<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Publisher;
use AppBundle\Form\Type\PublisherType;

class PublisherController extends RelatedController
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

}
