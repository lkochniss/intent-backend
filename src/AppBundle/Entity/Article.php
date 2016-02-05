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
class Article extends AbstractModel
{
    /**
     * @var Boolean
     *
     * @Assert\Type(
     *     type="bool"
     * )
     */
    private $slideshow;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var User
     */
    private $createdBy;

    /**
     * @var User
     */
    private $modifiedBy;

    /**
     * @var Event
     */
    private $event;

    /**
     * @var Related
     */
    private $related;

    /**
     * @var Image
     */
    private $thumbnail;

    /**
     * @var ArrayCollection
     */
    private $tags;

    /**
     * @var ArrayCollection
     */
    private $versions;

    /**
     * Set slideshow default to false.
     * Add empty tag array.
     */
    public function __construct()
    {
        $this->published = false;
        $this->slideshow = false;
        $this->tags = new ArrayCollection();
        $this->versions = new ArrayCollection();
    }

    /**
     * @return boolean
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * @param string $slideshow Set slideshow.
     * @return $this
     */
    public function setSlideshow($slideshow)
    {
        $this->slideshow = $slideshow;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isSlideshow()
    {
        return $this->slideshow;
    }

    /**
     * @param Category $category Set category.
     * @return $this
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param User|null $user Set createdBy user.
     * @return $this
     */
    public function setCreatedBy(User $user = null)
    {
        $this->createdBy = $user;

        return $this;
    }

    /**
     * @return User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param User|null $user Set modifiedBy user.
     * @return $this
     */
    public function setModifiedBy(User $user = null)
    {
        $this->modifiedBy = $user;

        return $this;
    }

    /**
     * @return User
     */
    public function getModifiedBy()
    {
        return $this->modifiedBy;
    }

    /**
     * @param Event|null $event Set event.
     * @return $this
     */
    public function setEvent(Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return Event
     */
    public function getEvent()
    {

        return $this->event;
    }

    /**
     * @param Related $related Set Related.
     * @return $this
     */
    public function setRelated(Related $related)
    {
        $this->related = $related;

        return $this;
    }

    /**
     * @return Related
     */
    public function getRelated()
    {

        return $this->related;
    }

    /**
     * @param Image|null $thumbnail Set Thumbnail.
     * @return $this
     */
    public function setThumbnail(Image $thumbnail = null)
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
     * @param Tag $tag Add tag to array.
     * @return $this
     */
    public function addTag(Tag $tag = null)
    {
        if (!is_null($tag) && !$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addArticle($this);
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
     * @return array
     */
    public function getTags()
    {
        return $this->tags->toArray();
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
        return $this->title;
    }
}
