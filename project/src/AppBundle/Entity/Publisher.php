<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Publisher
 */
class Publisher extends Related
{
     /**
      * @var ArrayCollection
      */
    private $franchises;

    /**
     * set empty franchise array
     */
    public function __construct()
    {
        parent::__construct();
        $this->franchises = new ArrayCollection();
    }

    /**
     * @param Franchise $franchise Add franchise to array.
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
     * @return string
     */
    public function getType()
    {
        return 'publisher';
    }
}
