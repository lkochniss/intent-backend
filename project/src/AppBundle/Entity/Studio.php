<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Studio
 */
class Studio extends Related
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
    private $games;

    function __construct()
    {
        $this->games = array();
    }


    /**
     * Set name
     *
     * @param string $name
     * @return Studio
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
     * @return Studio
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
     * @return Studio
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
     * @return Studio
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
     * @param Game $game
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
     * @param Game $game
     * @return $this
     */
    public function removeGame(Game $game)
    {
        $this->games->remove($game);

        return $this;
    }

    /**
     * @return Game[]
     */
    public function getGames()
    {
        return $this->games->toArray();
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->name;
    }


}
