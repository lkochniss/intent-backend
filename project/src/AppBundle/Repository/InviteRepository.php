<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Invite;


/**
 * InviteRepository
 */
class InviteRepository extends AbstractRepository
{
    /**
     * @param Invite $invite
     */
    public function save(Invite $invite)
    {
        $this->getEntityManager()->persist($invite);
        $this->getEntityManager()->flush();
    }
}
