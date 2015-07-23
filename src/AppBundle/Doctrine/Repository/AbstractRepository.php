<?php

namespace AppBundle\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 */
abstract class AbstractRepository extends EntityRepository
{
    public function save($entity){
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function delete($entity)
    {
        $this->getEntityManager()->remove($entity);
    }
}
