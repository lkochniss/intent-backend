<?php

namespace AppBundle\Repository;

use AppBundle\Entity\AbstractModel;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * AbstractRepository
 */
abstract class AbstractRepository extends EntityRepository
{
    /**
     * @param AbstractModel $entity
     */
    public function delete(AbstractModel $entity)
    {
        $this->getEntityManager()->remove($entity);
    }

    public function findPaginated($page, $size)
    {
        $offset = ($page * $size) - $size;

        /** @var \Doctrine\ORM\Query $query */
        $query = $this->getEntityManager()
            ->createQuery($this->getListDQL())
            ->setFirstResult($offset)
            ->setMaxResults($size);

        return new Paginator($query, false);
    }

    /**
     * @return string
     */
    abstract protected function getListDQL();
}
