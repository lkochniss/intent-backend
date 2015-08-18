<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Event;
use AppBundle\Entity\User;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends AbstractRepository
{
    /**
     * @param Event $event
     */
    public function save(Event $event, User $user)
    {
        $slug = preg_replace("/[^a-z0-9]+/", "-", strtolower($event->getName()));
        $event->setSlug($slug);
        $this->getEntityManager()->persist($event);
        $this->getEntityManager()->flush();
    }

    /**
     * @return string
     */
    protected function getListDQL()
    {
        return 'SELECT c
            FROM ' . $this->getEntityName() . ' c
            ORDER BY c.modifiedAt DESC';
    }
}
