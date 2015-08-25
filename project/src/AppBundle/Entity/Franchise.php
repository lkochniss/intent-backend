<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Franchise
 */
class Franchise extends Related
{
    /**
     * @var Publisher
     */
    private $publisher;

    /**
     * @var Studio
     */
    private $studio;

    /**
     * @var ArrayCollection
     */
    private $games;

    function __construct()
    {
        parent::__construct();
        $this->games = array();
    }

    /**
     * Set publisher
     *
     * @param Publisher $publisher
     * @return Franchise
     */
    public function setPublisher(Publisher $publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return Publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param Studio $studio
     * @return $this
     */
    public function setStudio(Studio $studio)
    {
        $this->studio = $studio;

        return $this;
    }

    /**
     * @return Studio
     */
    public function getStudio()
    {
        return $this->studio;
    }

    /**
     * @param Game $game
     * @return $this
     */
    public function addGame(Game $game)
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setFranchise($this);
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
     * @return Game[]
     */
    public function getGames()
    {
        return $this->games->toArray();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'franchise';
    }
}
