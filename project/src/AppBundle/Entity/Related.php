<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Related
 */
abstract class Related
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    private $articles;

    /**
     * @var string
     */
    private $type;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $modifiedAt;

    function __construct()
    {
        $this->articles = array();
    }


    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Article $article
     * @return $this
     */
    public function addArticle(Article $article)
    {
        if (!$this->articles->contains($article)){
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

    public function getArticles()
    {
        return $this->articles->toArray();
    }

    /**
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set modifiedAt
     *
     * @return \DateTime
     */
    public function setModifiedAt()
    {
        $this->modifiedAt = new \DateTime();

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * Set createdAt
     *
     * @return \DateTime
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
