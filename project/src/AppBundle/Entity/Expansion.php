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
     * @param Game $game Set Game.
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
