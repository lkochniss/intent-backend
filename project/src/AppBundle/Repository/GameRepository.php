<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Game;

/**
 * GameRepository
 */
class GameRepository extends AbstractRepository
{
    /**
     * @param Game $game
     */
    public function save(Game $game)
    {
        $slug = $this->slugify($game->getName());
        $game->setSlug($slug);
        $this->getEntityManager()->persist($game);
        $this->getEntityManager()->flush();
    }
}
