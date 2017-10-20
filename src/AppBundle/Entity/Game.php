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
     * @param Franchise $franchise
     */
    public function setFranchise(Franchise $franchise = null)
    {
        $this->franchise = $franchise;
    }

    /**
     * @return Franchise
     */
    public function getFranchise() : ?Franchise
    {
        return $this->franchise;
    }

    /**
     * @param Expansion $expansion
     */
    public function addExpansion(Expansion $expansion)
    {
        if (!$this->expansions->contains($expansion)) {
            $this->expansions->add($expansion);
            $expansion->setGame($this);
        }
    }

    /**
     * @param Expansion $expansion
     * @return $this
     */
    public function removeExpansion(Expansion $expansion)
    {
        $this->expansions->removeElement($expansion);
    }

    /**
     * @return array
     */
    public function getExpansions() : array
    {
        return $this->expansions->toArray();
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return 'game';
    }
}
