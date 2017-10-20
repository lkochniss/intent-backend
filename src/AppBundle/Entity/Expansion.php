<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

/**
 * Class Expansion
 */
class Expansion extends Related
{
    /**
     * @var Game
     */
    private $game;

    /**
     * @param Game $game
     * @return $this
     */
    public function setGame(Game $game = null)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return Game
     */
    public function getGame() : ?Game
    {
        return $this->game;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return 'dlc/expansion';
    }
}
