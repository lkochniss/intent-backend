<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\AbstractModel;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AbstractRepository
 */
abstract class AbstractRepository extends EntityRepository
{
    /**
     * @param string $string What you want to slugify.
     * @return string
     */
    public function slugify($string)
    {
        $string = preg_replace('/[^a-z0-9]+/', '-', strtolower($string));

//        $string = preg_replace('/[ä]+/', 'ae', $string);
//        $string = preg_replace('/[ö]+/', 'oe', $string);
//        $string = preg_replace('/[ü]+/', 'ue', $string);
//        $string = preg_replace('/[ß]+/', 'ss', $string);
//        $string = preg_replace('/[&]+/', 'and', $string);

        return $string;
    }

    /**
     * @param AbstractModel $entity Delete entity.
     * @return JsonResponse
     */
    public function delete(AbstractModel $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }
}
