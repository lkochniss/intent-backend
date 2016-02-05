<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\AbstractModel;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AbstractMetaRepository
 */
abstract class AbstractMetaRepository extends AbstractRepository
{
    /**
     * @param AbstractModel $entity Save entity.
     * @return JsonResponse
     */
    public function save(AbstractModel $entity)
    {
        $slug = $this->slugify($entity->getName());
        $entity->setSlug($slug);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }
}
