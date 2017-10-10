<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AbstractMetaModel
 */
abstract class AbstractMetaModel extends AbstractModel
{
    /**
     * @var String
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var String
     */
    private $slug;

    /**
     * @var Boolean
     *
     * @Assert\Type(
     *     type="bool"
     * )
     */
    private $published;

    /**
     * Initialize createdAt.
     * Set published default to false.
     */
    public function __construct()
    {
        parent::setCreatedAt();
        $this->published = false;
    }

    /**
     * @param string $name Set name.
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $slug Set auto generated slug.
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
    public function getSlug() : string
    {
        return $this->slug;
    }

    /**
     * @param boolean $published Set published.
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
    public function isPublished() : bool
    {
        return $this->published;
    }
}
