<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Page
 */
class Page extends AbstractModel
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
     * @var Boolean
     *
     * @Assert\Type(
     *     type="bool"
     * )
     */
    private $published;

    /**
     * Set slideshow default to false.
     * Add empty tag array.
     */
    public function __construct()
    {
        $this->published = false;
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
}
