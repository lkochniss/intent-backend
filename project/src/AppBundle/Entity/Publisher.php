<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Publisher
 */
class Publisher extends AbstractModel
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $backgroundLink;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var ArrayCollection
     */
    private $franchises;

    /**
     *
     */
    function __construct()
    {
        $this->franchises = array();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Publisher
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Publisher
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set backgroundLink
     *
     * @param string $backgroundLink
     * @return Publisher
     */
    public function setBackgroundLink($backgroundLink)
    {
        $this->backgroundLink = $backgroundLink;

        return $this;
    }

    /**
     * Get backgroundLink
     *
     * @return string
     */
    public function getBackgroundLink()
    {
        return $this->backgroundLink;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Publisher
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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
    function __toString()
    {
        return $this->name;
    }


}
