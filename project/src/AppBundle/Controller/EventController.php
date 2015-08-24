<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Form\Type\EventType;

class EventController extends AbstractCrudController
{
    /**
     * @return Event
     */
    protected function createNewEntity()
    {
        return new Event();
    }

    /**
     * @return EventType
     */
    protected function getFormType()
    {
        return new EventType();
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath()
    {
        return 'Event';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'AppBundle\Entity\Event';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return 'intent_backend_event';
    }

    protected function getTranslationDomain()
    {
        return 'event';
    }
}
