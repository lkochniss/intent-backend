<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Event;
use AppBundle\Entity\Tag;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class EventRepository
 */
class EventRepository extends AbstractRepository
{
    /**
     * @param string $name The name to check for.
     * @return JsonResponse
     */
    protected function generateTag($name)
    {
        $tagRepository = $this->getEntityManager()->getRepository('AppBundle:Tag');
        $tag = $tagRepository->findOneBy(array('name' => $name));

        if (is_null($tag)) {
            $tag = new Tag();
            $tag->setName($name);
            $tagRepository->save($tag);

            return new JsonResponse('tag created');
        }

        return new JsonResponse('tag exists');
    }

    /**
     * @param Event $event Persist event.
     * @return JsonResponse
     */
    public function save(Event $event)
    {
        $this->generateTag($event->getName());

        $slug = $this->slugify($event->getName());
        $event->setSlug($slug);
        $this->getEntityManager()->persist($event);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }
}
