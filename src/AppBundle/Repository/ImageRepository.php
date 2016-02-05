<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Image;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ImageRepository
 */
class ImageRepository extends AbstractRepository
{
    /**
     * @param Image $image Persist image.
     * @return JsonResponse
     */
    public function save(Image $image)
    {
        $image->setPath($this->slugify($image->getName()));
        $image->upload();
        $this->getEntityManager()->persist($image);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }
}
