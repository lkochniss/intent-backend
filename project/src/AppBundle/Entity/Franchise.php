<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Franchise
 */
class Franchise
{
    /**
     * @var integer
     */
    private $id;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Franchise
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
     * @return Franchise
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
     * @return Franchise
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
     * @return Franchise
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
}
