<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
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
    protected function createNewEntity() : AbstractModel
    {
        return new Event();
    }

    /**
     * @return string
     */
    protected function getFormType() : string
    {
        return EventType::class;
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath() : string
    {
        return 'Event';
    }

    /**
     * @return string
     */
    protected function getEntityName() : string
    {
        return 'AppBundle\Entity\Event';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix() : string
    {
        return 'intent_backend_event';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain() : string
    {
        return 'event';
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
