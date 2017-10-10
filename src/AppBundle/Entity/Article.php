<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

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
     * Add empty tags array and setup published and slideshow as false
     */
    public function __construct()
    {
        $this->published = false;
        $this->slideshow = false;
        $this->tags = new ArrayCollection();
    }

    /**
     * @param String $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @param String $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug() : string
    {
        return $this->slug;
    }

    /**
     * @param String $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * @param \DateTime $publishAt
     */
    public function setPublishAt(\DateTime $publishAt)
    {
        $this->publishAt = $publishAt;
    }

    /**
     * @return \DateTime
     */
    public function getPublishAt() : \DateTime
    {
        return $this->publishAt;
    }

    /**
     * @param boolean $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * @return boolean
     */
    public function isPublished() : bool
    {
        return $this->published;
    }

    /**
     * @param string $slideshow
     */
    public function setSlideshow($slideshow)
    {
        $this->slideshow = $slideshow;
    }

    /**
     * @return boolean
     */
    public function isSlideshow() : bool
    {
        return $this->slideshow;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;
    }

    /**
     * @return Category
     */
    public function getCategory() : Category
    {
        return $this->category;
    }

    /**
     * @param User|null $user
     */
    public function setCreatedBy(User $user = null)
    {
        $this->createdBy = $user;
    }

    /**
     * @return User
     */
    public function getCreatedBy() : User
    {
        return $this->createdBy;
    }

    /**
     * @param User|null $user
     */
    public function setModifiedBy(User $user = null)
    {
        $this->modifiedBy = $user;
    }

    /**
     * @return User
     */
    public function getModifiedBy() : User
    {
        return $this->modifiedBy;
    }

    /**
     * @param Event|null $event
     */
    public function setEvent(Event $event = null)
    {
        $this->event = $event;
    }

    /**
     * @return Event
     */
    public function getEvent() : Event
    {

        return $this->event;
    }

    /**
     * @param Related|null
     */
    public function setRelated(Related $related = null)
    {
        $this->related = $related;
    }

    /**
     * @return Related
     */
    public function getRelated() : Related
    {

        return $this->related;
    }

    /**
     * @param Image|null $thumbnail
     */
    public function setThumbnail(Image $thumbnail = null)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return Image
     */
    public function getThumbnail() : Image
    {
        return $this->thumbnail;
    }

    /**
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }
    }

    /**
     * @param Tag $tag
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags)
    {
        foreach ($tags as $tag) {
            $this->addTag($tag);
        }
    }

    /**
     * @return array
     */
    public function getTags() : array
    {
        return $this->tags->toArray();
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->getTitle();
    }
}
