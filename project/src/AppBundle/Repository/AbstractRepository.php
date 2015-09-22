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
        $string = strtolower($string);
        $string = str_replace('ä', 'ae', $string);
        $string = str_replace('ö', 'oe', $string);
        $string = str_replace('ü', 'ue', $string);
        $string = str_replace('ß', 'ss', $string);
        $string = str_replace('&', '-and-', $string);
        $string = preg_replace('/[^a-z0-9]+/', '-', $string);

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
