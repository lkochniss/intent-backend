<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 */
class Article extends AbstractModel
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $content;

    /**
     * @var boolean
     */
    private $slideshow;

    /**
     * @var \DateTime
     */
    private $publishAt;

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
     * @var ArrayCollection
     */
    private $tags;

    function __construct()
    {
        $this->slideshow = false;
        $this->tags = array();
    }


    /**
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Article
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
     * Set content
     *
     * @param string $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set slideshow
     *
     * @param boolean $slideshow
     * @return Article
     */
    public function setSlideshow($slideshow)
    {
        $this->slideshow = $slideshow;

        return $this;
    }

    /**
     * Get slideshow
     *
     * @return boolean
     */
    public function getSlideshow()
    {
        return $this->slideshow;
    }

    /**
     * Set publishAt
     *
     * @param \DateTime $publishAt
     * @return Article
     */
    public function setPublishAt($publishAt)
    {
        $this->publishAt = $publishAt;

        return $this;
    }

    /**
     * Get publishAt
     *
     * @return \DateTime
     */
    public function getPublishAt()
    {
        return $this->publishAt;
    }

    /**
     * Set category
     *
     * @param Category $category
     * @return Article
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set createdBy
     *
     * @param User $user
     * @return User
     */
    public function setCreatedBy(User $user)
    {
        $this->createdBy = $user;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set modifiedBy
     *
     * @param User $user
     * @return User
     */
    public function setModifiedBy(User $user)
    {
        $this->modifiedBy = $user;

        return $this;
    }

    /**
     * Get modifiedBy
     *
     * @return User
     */
    public function getModifiedBy()
    {
        return $this->modifiedBy;
    }

    /**
     * @param Event $event
     * @return $this
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return Event
     */
    public function getEvent(){

        return $this->event;
    }

    /**
     * @param Related $related
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
    public function getRelated(){

        return $this->related;
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function addTag(Tag $tag)
    {
        if (!$this->tags->contains($tag)){
            $this->tags->add($tag);
            $tag->addArticle($this);
        }

        return $this;
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->remove($tag);

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
     * @return $this
     */
    public function resetTags()
    {
        $this->tags = array();

        return $this;
    }

}
