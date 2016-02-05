<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ArticleVersion
 */
class ArticleVersion extends AbstractModel
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
     * @var Article
     */
    private $article;

    /**
     * Set slideshow default to false.
     * Add empty tag array.
     */
    public function __construct()
    {
        $this->published = false;
        $this->slideshow = false;
        $this->tags = new ArrayCollection();
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
     * @param Related|null $related Set Related.
     * @return $this
     */
    public function setRelated(Related $related = null)
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
     * @param Article $article Set article.
     * @return $this
     */
    public function setArticle(Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * @param Article $article Get article.
     * @return Article
     */
    public function getArticle(Article $article)
    {
        return $this->article;
    }
}
