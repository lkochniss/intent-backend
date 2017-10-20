<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Event
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

    /**
     * Set start and end date.
     * Add empty article array.
     */
    public function __construct()
    {
        parent::__construct();
        $this->articles = new ArrayCollection();
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->stringTransform($this->description);
    }

    /**
     * @param string $backgroundLink
     */
    public function setBackgroundLink($backgroundLink)
    {
        $this->backgroundLink = $backgroundLink;
    }

    /**
     * @return string
     */
    public function getBackgroundLink() : ?string
    {
        return $this->backgroundLink;
    }

    /**
     * @param \DateTime $startAt
     */
    public function setStartAt(\DateTime $startAt)
    {
        $this->startAt = $startAt;
    }

    /**
     * @return \DateTime
     */
    public function getStartAt() : \DateTime
    {
        return $this->datetimeTransform($this->startAt);
    }

    /**
     * @param \DateTime $endAt
     */
    public function setEndAt(\DateTime $endAt)
    {
        $this->endAt = $endAt;
    }

    /**
     * @return \DateTime
     */
    public function getEndAt() : \DateTime
    {
        return $this->datetimeTransform($this->endAt);
    }

    /**
     * @param Image $backgroundImage
     * @return $this
     */
    public function setBackgroundImage(Image $backgroundImage)
    {
        $this->backgroundImage = $backgroundImage;

        return $this;
    }

    /**
     * @return Image
     */
    public function getBackgroundImage() : ?Image
    {
        return $this->backgroundImage;
    }

    /**
     * @param Image $thumbnail
     */
    public function setThumbnail(Image $thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return Image
     */
    public function getThumbnail() : ?Image
    {
        return $this->thumbnail;
    }

    /**
     * @param Article $article
     */
    public function addArticle(Article $article)
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setEvent($this);
        }
    }

    /**
     * @param Article $article
     * @return $this
     */
    public function removeArticle(Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * @return array
     */
    public function getArticles() : array
    {
        return $this->articles->toArray();
    }

    /**
     * @return boolean
     */
    public function isActive() : bool
    {
        $now = new \DateTime();

        return $now > $this->startAt && $now < $this->endAt ? true : false;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->getName();
    }
}
