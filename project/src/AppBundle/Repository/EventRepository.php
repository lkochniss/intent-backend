<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Event;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class EventRepository
 */
class EventRepository extends AbstractRepository
{
    /**
     * @param Event $event Persist event.
     * @return JsonResponse
     */
    public function save(Event $event)
    {
        $slug = $this->slugify($event->getName());
        $event->setSlug($slug);
        $this->getEntityManager()->persist($event);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }
}
