<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Category
 */
class Category extends AbstractMetaModel
{
    /**
     * @var integer
     *
     * @Assert\Type(
     *     type="integer"
     * )
     */
    private $priority;

    /**
     * @var ArrayCollection
     */
    private $articles;

    /**
     * add empty article array
     */
    public function __construct()
    {
        parent::__construct();
        $this->articles = array();
    }

    /**
     * @param integer $priority Set priority.
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPriority() : int
    {
        return $this->integerTransform($this->priority);
    }

    /**
     * @param Article $article
     */
    public function addArticle(Article $article)
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setCategory($this);
        }
    }

    /**
     * @param Article $article
     */
    public function removeArticle(Article $article)
    {
        $this->articles->remove($article);
    }

    /**
     * @return array
     */
    public function getArticles()
    {
        return $this->articles->toArray();
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->getName();
    }
}
