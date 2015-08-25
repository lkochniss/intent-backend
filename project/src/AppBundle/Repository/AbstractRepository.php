<?php

namespace AppBundle\Repository;

use AppBundle\Entity\AbstractModel;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * AbstractRepository
 */
abstract class AbstractRepository extends EntityRepository
{
    protected function slugify($string)
    {
        return preg_replace("/[^a-z0-9]+/", "-", strtolower($string));
    }

    /**
     * @param AbstractModel $entity
     */
    public function delete(AbstractModel $entity)
    {
        $this->getEntityManager()->remove($entity);
    }
}
