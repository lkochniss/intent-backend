<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\AbstractModel;
use AppBundle\Entity\Tag;
use Doctrine\ORM\Mapping;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AbstractRelatedRepository
 */
abstract class AbstractRelatedRepository extends AbstractRepository
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
     * @param AbstractModel $entity Save entity.
     * @return JsonResponse
     */
    public function save(AbstractModel $entity)
    {
        $this->generateTag($entity->getName());

        $slug = $this->slugify($entity->getName());
        $entity->setSlug($slug);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }
}
