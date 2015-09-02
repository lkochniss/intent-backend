<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Game
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

    public function __construct()
    {
        parent::__construct();
        $this->expansions = array();
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
     * @param Franchise $franchise
     * @return $this
     */
    public function setFranchise(Franchise $franchise)
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
     * @param Expansion $expansion
     * @return $this
     */
    public function addExpansion(Expansion $expansion)
    {
        if (!$this->expansions->contains($expansion)){
            $this->expansions->add($expansion);
            $expansion->setGame($this);
        }

        return $this;
    }

    /**
     * @param Expansion $expansion
     * @return $this
     */
    public function removeExpansion(Expansion $expansion)
    {
        $this->expansions->remove($expansion);

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
