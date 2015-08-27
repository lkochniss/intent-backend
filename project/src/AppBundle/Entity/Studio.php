<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Studio
 */
class Studio extends Related
{
    /**
     * @var ArrayCollection
     */
    private $franchises;

    /**
     * @var ArrayCollection
     */
    private $games;

    function __construct()
    {
        parent::__construct();
        $this->franchises = array();
        $this->games = array();
    }

    /**
     * @param Franchise $franchise
     * @return $this
     */
    public function addFranchise(Franchise $franchise)
    {
        if (!$this->franchises->contains($franchise)) {
            $this->franchises->add($franchise);
            $franchise->setStudio($this);
        }

        return $this;
    }

    /**
     * @param Franchise $franchise
     * @return $this
     */
    public function removeFranchise(Franchise $franchise)
    {
        $this->franchises->remove($franchise);

        return $this;
    }

    /**
     * @return array
     */
    public function getFranchises()
    {
        return $this->franchises->toArray();
    }

    /**
     * @param Game $game
     * @return $this
     */
    public function addGame(Game $game)
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setStudio($this);
        }

        return $this;
    }

    /**
     * @param Game $game
     * @return $this
     */
    public function removeGame(Game $game)
    {
        $this->games->remove($game);

        return $this;
    }

    /**
     * @return array
     */
    public function getGames()
    {
        return $this->games->toArray();
    }

    /**
     * @return String
     */
    public function getType()
    {
        return 'studio';
    }
}
