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

    /**
     * @param User $user The user we don't want selected.
     * @return array
     */
    public function findAllUsersBut(User $user)
    {
        $queryBuilder = $this->createQueryBuilder('u');
        $queryBuilder->where('u.id != :id')
            ->setParameter('id', $user->getId());

        return $queryBuilder->getQuery()->getResult();
    }
}
