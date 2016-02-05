<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

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
     * Add empty version array
     */
    public function __construct()
    {
        parent::__construct();
        $this->versions = new ArrayCollection();
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
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}
