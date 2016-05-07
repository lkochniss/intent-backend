<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Article
 */
class Article extends AbstractArticleModel
{
    /**
     * @var ArrayCollection
     */
    private $versions;

    /**
     * @var ArrayCollection
     */
    private $tags;

    /**
     * Add empty version array
     */
    public function __construct()
    {
        parent::__construct();
        $this->versions = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    /**
     * @param ArticleVersion $articleVersion Add new version.
     * @return $this
     */
    public function addVersion(ArticleVersion $articleVersion)
    {
        if (!$this->versions->contains($articleVersion)) {
            $this->versions->add($articleVersion);
            $articleVersion->setArticle($this);
        }

        return $this;
    }

    /**
     * @param ArticleVersion $articleVersion Remove version from array.
     * @return $this
     */
    public function removeVersion(ArticleVersion $articleVersion)
    {
        $this->versions->removeElement($articleVersion);

        return $this;
    }

    /**
     * @return array
     */
    public function getVersions()
    {
        return $this->versions->toArray();
    }

    /**
     * @param Tag $tag Add tag to array.
     * @return $this
     */
    public function addTag(Tag $tag)
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    /**
     * @param Tag $tag Remove tag from array.
     * @return $this
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @param array $tags Tags from article.
     * @return null
     */
    public function setTags(array $tags)
    {
        foreach ($tags as $tag) {
            $this->addTag($tag);
        }

        return null;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags->toArray();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}
