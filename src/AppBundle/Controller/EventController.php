<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Form\Type\EventType;

/**
 * Class EventController
 */
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
        return EventType::class;
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

    /**
     * @return string
     */
    protected function getTranslationDomain()
    {
        return 'event';
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
