<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Related
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
     * set empty articles array
     */
    public function __construct()
    {
        parent::__construct();
        $this->articles = array();
    }

    /**
     * @param string $description Set description.
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $backgroundLink Set a background link.
     * @return $this
     */
    public function setBackgroundLink($backgroundLink)
    {
        $this->backgroundLink = $backgroundLink;

        return $this;
    }

    /**
     * @return string
     */
    public function getBackgroundLink()
    {
        return $this->backgroundLink;
    }

    /**
     * @param Image $backgroundImage Set a background image.
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
    public function getBackgroundImage()
    {
        return $this->backgroundImage;
    }

    /**
     * @param Image $thumbnail Set a thumbnail.
     * @return $this
     */
    public function setThumbnail(Image $thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * @return Image
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param Article $article Add an article to array.
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
     * @param Article $article Remove article from array.
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
     * @return string
     */
    abstract public function getType();

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName() . ' (' . $this->getType() . ')';
    }
}
