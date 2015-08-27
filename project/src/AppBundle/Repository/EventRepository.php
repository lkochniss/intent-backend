<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Event;

/**
 * GameRepository
 */
class EventRepository extends AbstractRepository
{
    /**
     * @param Event $event
     */
    public function save(Event $event)
    {
        $slug = $this->slugify($event->getName());
        $event->setSlug($slug);
        $this->getEntityManager()->persist($event);
        $this->getEntityManager()->flush();
    }
}
