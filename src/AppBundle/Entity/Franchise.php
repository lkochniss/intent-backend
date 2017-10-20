<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Franchise
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

    /**
     * add empty games array
     */
    public function __construct()
    {
        parent::__construct();
        $this->games = new ArrayCollection();
    }

    /**
     * @param Publisher $publisher
     */
    public function setPublisher(Publisher $publisher = null)
    {
        $this->publisher = $publisher;
    }

    /**
     * @return Publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param Studio $studio
     */
    public function setStudio(Studio $studio = null)
    {
        $this->studio = $studio;
    }

    /**
     * @return Studio
     */
    public function getStudio() : ?Studio
    {
        return $this->studio;
    }

    /**
     * @param Game $game
     */
    public function addGame(Game $game)
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setFranchise($this);
        }
    }

    /**
     * @param Game $game
     * @return $this
     */
    public function removeGame(Game $game)
    {
        $this->games->removeElement($game);
    }

    /**
     * @return array
     */
    public function getGames() : array
    {
        return $this->games->toArray();
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return 'franchise';
    }
}
