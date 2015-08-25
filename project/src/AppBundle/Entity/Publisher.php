<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Publisher
 */
class Publisher extends Related
{
     /**
     * @var ArrayCollection
     */
    private $franchises;

    /**
     *
     */
    function __construct()
    {
        parent::__construct();
        $this->franchises = array();
    }

    /**
     * @param Franchise $franchise
     * @return $this
     */
    public function addFranchise(Franchise $franchise)
    {
        if (!$this->franchises->contains($franchise)) {
            $this->franchises->add($franchise);
            $franchise->setPublisher($this);
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
     * @return Franchise[]
     */
    public function getFranchises()
    {
        return $this->franchises->toArray();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'publisher';
    }
}
