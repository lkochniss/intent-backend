<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Role;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class RoleRepository
 */
class RoleRepository extends EntityRepository
{
    /**
     * @param Role $role Persist role.
     * @return JsonResponse
     */
    public function save(Role $role)
    {
        $this->getEntityManager()->persist($role);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }
}
