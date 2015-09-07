<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Event
 */
class Event extends AbstractMetaModel
{
    /**
     * @var String
     *
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var String
     */
    private $backgroundLink;

    /**
     * @var \DateTime
     *
     * @Assert\Date()
     */
    private $startAt;

    /**
     * @var \DateTime
     *
     * @Assert\Date()
     * @Assert\Expression(
     *     "value > this.getStartAt()"
     * )
     */
    private $endAt;

    /**
     * @var Image
     */
    private $backgroundImage;

    /**
     * @var Image
     */
    private $thumbnail;

    /**
     * @var ArrayCollection
     */
    private $articles;

    function __construct()
    {
        parent::__construct();
        $this->startAt = new \DateTime();
        $this->endAt = new \DateTime();
        $this->articles = array();
    }

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $backgroundLink
     * @return $this
     */
    public function setBackgroundLink($backgroundLink)
    {
        $this->backgroundLink = $backgroundLink;

        return $this;
    }

    /**
     * @return String
     */
    public function getBackgroundLink()
    {
        return $this->backgroundLink;
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
     * @param Image $backgroundImage
     */
    public function setBackgroundImage($backgroundImage)
    {
        $this->backgroundImage = $backgroundImage;
    }

    /**
     * @return Image
     */
    public function getBackgroundImage()
    {
        return $this->backgroundImage;
    }

    /**
     * @param Image $thumbnail
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return Image
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param Article $article
     * @return $this
     */
    public function addArticle(Article $article)
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setEvent($this);
        }

        return $this;
    }

    /**
     * @param Article $article
     * @return $this
     */
    public function removeArticle(Article $article)
    {
        $this->articles->remove($article);

        return $this;
    }

    /**
     * @return array
     */
    public function getArticles()
    {
        return $this->articles->toArray();
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        $now = new \DateTime();

        return $now > $this->startAt && $now < $this->endAt ? true : false;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->getName();
    }


}
