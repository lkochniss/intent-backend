<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Game
 */
class Game extends Related
{
    /**
     * @var Studio
     */
    private $studio;

    /**
     * @var Franchise
     */
    private $franchise;

    /**
     * @var ArrayCollection
     */
    private $expansions;

    /**
     * add empty expansion array
     */
    public function __construct()
    {
        parent::__construct();
        $this->expansions = new ArrayCollection();
    }


    /**
     * @param Studio $studio Set studio for game.
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
     * @param Franchise $franchise Set franchise for game.
     * @return $this
     */
    public function setFranchise(Franchise $franchise = null)
    {
        $this->franchise = $franchise;

        return $this;
    }

    /**
     * @return Franchise
     */
    public function getFranchise()
    {
        return $this->franchise;
    }

    /**
     * @param Expansion $expansion Add expansion to array.
     * @return $this
     */
    public function addExpansion(Expansion $expansion)
    {
        if (!$this->expansions->contains($expansion)) {
            $this->expansions->add($expansion);
            $expansion->setGame($this);
        }

        return $this;
    }

    /**
     * @param Expansion $expansion Remove expansion from array.
     * @return $this
     */
    public function removeExpansion(Expansion $expansion)
    {
        $this->expansions->removeElement($expansion);

        return $this;
    }

    /**
     * @return array
     */
    public function getExpansions()
    {
        return $this->expansions->toArray();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'game';
    }
}
