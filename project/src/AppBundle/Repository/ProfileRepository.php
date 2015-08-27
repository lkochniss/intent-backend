<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Profile;

/**
 * ProfileRepository
 */
class ProfileRepository extends AbstractRepository
{
    /**
     * @param Profile $profile
     */
    public function save(Profile $profile)
    {
        $this->getEntityManager()->persist($profile);
        $this->getEntityManager()->flush();
    }
}
