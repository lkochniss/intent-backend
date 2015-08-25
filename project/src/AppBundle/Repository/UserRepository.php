<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends AbstractRepository
{
    /**
     * @param User $user
     * @param User $creator
     */
    public function save(User $user, User $creator)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }
}
