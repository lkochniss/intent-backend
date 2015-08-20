<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 */
class Tag extends AbstractModel
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var ArrayCollection
     */
    private $articles;

    function __construct()
    {
        $this->articles = array();
    }


    /**
     * Set name
     *
     * @param string $name
     * @return Tag
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
     * Set slug
     *
     * @param string $slug
     * @return Tag
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
     * @param Article $article
     * @return $this
     */
    public function addArticle(Article $article)
    {
        if(!$this->articles->contains($article)){
            $this->articles->add($article);
            $article->addTag($this);
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
}
