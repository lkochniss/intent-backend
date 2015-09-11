<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class UserRepository
 */
class UserRepository extends AbstractRepository
{
    /**
     * @param User $user Persist user.
     * @return JsonResponse
     */
    public function save(User $user)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }
}
