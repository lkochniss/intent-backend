<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Related
 */
abstract class Related extends AbstractMetaModel
{
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
        parent::__construct();
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
        return $this->getName().' ('.$this->getType().')';
    }
}
