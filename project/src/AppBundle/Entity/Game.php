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
     * Get franchise
     *
     * @return Franchise
     */
    public function getFranchise()
    {
        return $this->franchise;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'game';
    }
}
