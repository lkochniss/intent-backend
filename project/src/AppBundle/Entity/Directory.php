<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Directory
 */
class Directory extends AbstractModel
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
    private $path;

    /**
     * @var String
     */
    private $fullPath;

    /**
     * @var Directory
     */
    private $parentDirectory;

    /**
     * @var ArrayCollection
     * @OrderBy({"name" = "ASC"})
     */
    private $images;

    /**
     * @var ArrayCollection;
     * @OrderBy({"name" = "ASC"})
     */
    private $childDirectories;

    /**
     * add empty array for childDirectories
     * add empty array for images
     */
    public function __construct()
    {
        $this->childDirectories = new ArrayCollection();
        $this->images = new ArrayCollection();
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
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path Set path.
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        $this->updateFullpath();

        return $this;
    }

    /**
     * @return null
     */
    public function updateFullpath()
    {
        $this->resetFullPath();
        foreach ($this->childDirectories as $childDirectory) {
            $childDirectory->resetFullPath();
        }

        foreach ($this->images as $image) {
            $image->resetFullPath();
        }

        return null;
    }

    /**
     * @return string
     */
    public function resetFullPath()
    {
        if ($this->isRootNode()) {
            $this->fullPath = $this->path;

            return $this;
        }

        $this->fullPath = $this->parentDirectory->getFullPath() . '/' . $this->path;

        return $this;
    }

    /**
     * @return string
     */
    public function getFullPath()
    {
        return $this->fullPath;
    }

    /**
     * @param Directory|null $parentDirectory Set parentDirectory.
     * @return $this
     */
    public function setParentDirectory(Directory $parentDirectory = null)
    {
        $this->parentDirectory = $parentDirectory;

        return $this;
    }

    /**
     * @return Directory
     */
    public function getParentDirectory()
    {
        return $this->parentDirectory;
    }

    /**
     * @param Directory $directory Add childDirectory to array.
     * @return $this
     */
    public function addChildDirectory(Directory $directory)
    {
        if (!$this->childDirectories->contains($directory)) {
            $this->childDirectories->add($directory);

            $directory->setParentDirectory($this);
        }

        return $this;
    }

    /**
     * @param Directory $directory Remove childDirectory from array.
     * @return $this
     */
    public function removeChildDirectory(Directory $directory)
    {
        $this->childDirectories->removeElement($directory);

        return $this;
    }

    /**
     * @return array
     */
    public function getChildDirectories()
    {
        return $this->childDirectories->toArray();
    }

    /**
     * @param Image $image Add image to array.
     * @return $this
     */
    public function addImage(Image $image)
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);

            $image->setParentDirectory($this);
        }

        return $this;
    }

    /**
     * @param Image $image Remove image from array.
     * @return $this
     */
    public function removeImages(Image $image)
    {
        $this->images->removeElement($image);

        return $this;
    }

    /**
     * @return array
     */
    public function getImages()
    {
        return $this->images->toArray();
    }

    /**
     * @return boolean
     */
    public function isRootNode()
    {
        if (is_null($this->parentDirectory)) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->path;
    }
}
