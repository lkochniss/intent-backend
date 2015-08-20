<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Game;
use AppBundle\Entity\User;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GameRepository extends AbstractRepository
{
    /**
     * @param Game $game
     */
    public function save(Game $game, User $user)
    {
        $slug = $this->slugify($game->getName());
        $game->setSlug($slug);
        $this->getEntityManager()->persist($game);
        $this->getEntityManager()->flush();
    }

    /**
     * @return string
     */
    protected function getListDQL()
    {
        return 'SELECT c
            FROM ' . $this->getEntityName() . ' c
            ORDER BY c.modifiedAt DESC';
    }
}
