<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Article
 */
class Article extends AbstractModel
{
    /**
     * @var String
     *
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var String
     */
    private $slug;

    /**
     * @var String
     *
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     */
    private $publishAt;

    /**
     * @var Boolean
     *
     * @Assert\Type(
     *     type="bool"
     * )
     */
    private $published;

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
     * @param String $title The title of the entity.
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param String $slug The automatic generated slug.
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param String $content Set the written content.
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param \DateTime $publishAt Set the date when the entity should be published.
     * @return $this
     */
    public function setPublishAt(\DateTime $publishAt)
    {
        $this->publishAt = $publishAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishAt()
    {
        return $this->publishAt;
    }

    /**
     * @param boolean $published Set true when publishing to frontend returns true.
     * @return $this
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
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
    public function setCategory(Category $category)
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
    public function addTag(Tag $tag)
    {
        if (!$this->tags->contains($tag)) {
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
