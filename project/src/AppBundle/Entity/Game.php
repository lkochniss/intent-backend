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
     * @param Studio $studio
     * @return $this
     */
    public function setStudio(Studio $studio)
    {
        $this->studio = $studio;

        return $this;
    }

    /**
     * Get franchise
     *
     * @return string
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
     * Get franchise
     *
     * @return string
     */
    public function getFranchise()
    {
        return $this->franchise;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return parent::__toString().' (game)';
    }
}
