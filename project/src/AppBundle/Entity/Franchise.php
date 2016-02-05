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
     * @param Publisher $publisher Set Publisher for franchise.
     * @return $this
     */
    public function setPublisher(Publisher $publisher = null)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * @return Publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param Studio $studio Set studio for franchise.
     * @return $this
     */
    public function setStudio(Studio $studio = null)
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
     * @param Game $game Add games to array.
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
     * @param Game $game Remove games from array.
     * @return $this
     */
    public function removeGame(Game $game)
    {
        $this->games->removeElement($game);

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
     * @return string
     */
    public function getType()
    {
        return 'franchise';
    }
}
