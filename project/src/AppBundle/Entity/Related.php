<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Related
 */
abstract class Related extends AbstractModel
{
    /**
     * @var String
     */
    private $name;

    /**
     * @var String
     */
    private $slug;

    /**
     * @var String
     */
    private $description;

    /**
     * @var String
     */
    private $backgroundLink;

    /**
     * @var ArrayCollection
     */
    private $articles;

    function __construct()
    {
        parent::setCreatedAt();
        $this->articles = array();
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return String
     */
    public function getSlug()
    {
        return $this->slug;
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
     * @param Article $article
     * @return $this
     */
    public function addArticle(Article $article)
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setRelated($this);
        }

        return $this;
    }

    /**
     * @param Article $article
     * @return ArrayCollection
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
     * @return String
     */
    abstract public function getType();

    /**
     * @return String
     */
    function __toString()
    {
        return $this->name.' ('.$this->getType().')';
    }
}
