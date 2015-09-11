<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Directory;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class DirectoryRepository
 */
class DirectoryRepository extends AbstractRepository
{
    /**
     * @param Directory $directory Persist directory.
     * @return JsonResponse
     */
    public function save(Directory $directory)
    {
        $path = $this->slugify($directory->getName());
        $directory->setPath($path);

        $this->getEntityManager()->persist($directory);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }
}
