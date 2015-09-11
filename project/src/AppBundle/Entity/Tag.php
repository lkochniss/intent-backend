<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Tag
 */
class Tag extends AbstractMetaModel
{
    /**
     * @var ArrayCollection
     */
    private $articles;

    /**
     * init
     */
    public function __construct()
    {
        parent::__construct();
        $this->articles = array();
    }

    /**
     * @param Article $article Add article to array.
     * @return $this
     */
    public function addArticle(Article $article)
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->addTag($this);
        }

        return $this;
    }

    /**
     * @param Article $article Remove article from array.
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
