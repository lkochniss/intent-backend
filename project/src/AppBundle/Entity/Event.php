<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 */
class Event extends AbstractModel
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
     * @var \DateTime
     */
    private $startAt;

    /**
     * @var \DateTime
     */
    private $endAt;

    /**
     * @var ArrayCollection
     */
    private $games;

    function __construct()
    {
        $this->startAt = new \DateTime();
        $this->endAt = new \DateTime();
        $this->games = array();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Event
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
     * @return Event
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
     * @return Event
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
     * @return Event
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
     * @param \DateTime $startAt
     * @return $this
     */
    public function setStartAt(\DateTime $startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * @param \DateTime $endAt
     * @return $this
     */
    public function setEndAt(\DateTime $endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * @param Game $game
     * @return $this
     */
    public function addGames(Game $game)
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->addEvent($this);
        }

        return $this;
    }

    /**
     * @param Game $game
     * @return $this
     */
    public function removeGames(Game $game)
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
