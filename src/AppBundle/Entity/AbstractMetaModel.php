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
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->stringTransform($this->name);
    }

    /**
     * @param string $slug
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
        return $this->stringTransform($this->slug);
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
}
