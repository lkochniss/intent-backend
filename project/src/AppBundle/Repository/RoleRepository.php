<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Role;
use Doctrine\ORM\EntityRepository;

/**
 * RoleRepository
 */
class RoleRepository extends EntityRepository
{
    public function save(Role $role)
    {
        $this->getEntityManager()->persist($role);
        $this->getEntityManager()->flush();
    }
}
