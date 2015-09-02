<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expansion
 */
class Expansion extends Related
{
    /**
     * @var Game
     */
    private $game;

    /**
     * @param Game $game
     */
    public function setGame($game)
    {
        $this->game = $game;
    }

    /**
     * @return Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'dlc/expansion';
    }
}
