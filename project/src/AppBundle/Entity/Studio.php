<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Studio
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

    /**
     * set franchises and games
     */
    public function __construct()
    {
        parent::__construct();
        $this->franchises = new ArrayCollection();
        $this->games = new ArrayCollection();
    }

    /**
     * @param Franchise $franchise Add franchise to array.
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
     * @param Franchise $franchise Remove franchise from array.
     * @return $this
     */
    public function removeFranchise(Franchise $franchise)
    {
        $this->franchises->removeElement($franchise);

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
     * @param Game $game Add game to array.
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
     * @param Game $game Remove game from array.
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
        return 'studio';
    }
}
