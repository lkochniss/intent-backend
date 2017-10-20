<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OrderBy({"name" = "ASC"})
     */
    private $images;

    /**
     * @var ArrayCollection;
     * @ORM\OrderBy({"name" = "ASC"})
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
     * @return string
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
        $this->updateFullpath();
    }

    /**
     * @return string
     */
    public function resetFullPath()
    {
        if ($this->isRootNode()) {
            $this->fullPath = $this->path;
        }else {
            $this->fullPath = $this->parentDirectory->getFullPath() . '/' . $this->path;
        }
    }

    /**
     * @return string
     */
    public function getFullPath() : string
    {
        return $this->fullPath;
    }

    /**
     * @param Directory|null $parentDirectory
     */
    public function setParentDirectory(Directory $parentDirectory = null)
    {
        $this->parentDirectory = $parentDirectory;
    }

    /**
     * @return Directory
     */
    public function getParentDirectory() : ?Directory
    {
        return $this->parentDirectory;
    }

    /**
     * @param Directory $directory
     */
    public function addChildDirectory(Directory $directory)
    {
        if (!$this->childDirectories->contains($directory)) {
            $this->childDirectories->add($directory);

            $directory->setParentDirectory($this);
        }
    }

    /**
     * @param Directory $directory
     * @return $this
     */
    public function removeChildDirectory(Directory $directory)
    {
        $this->childDirectories->removeElement($directory);
    }

    /**
     * @return array
     */
    public function getChildDirectories() : array
    {
        return $this->childDirectories->toArray();
    }

    /**
     * @param Image $image
     */
    public function addImage(Image $image)
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);

            $image->setParentDirectory($this);
        }
    }

    /**
     * @param Image $image
     */
    public function removeImages(Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * @return array
     */
    public function getImages() : array
    {
        return $this->images->toArray();
    }

    /**
     * @return boolean
     */
    public function isRootNode() : bool
    {
        if (is_null($this->parentDirectory)) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->fullPath . $this->name;
    }

    private function updateFullpath()
    {
        $this->resetFullPath();
        foreach ($this->childDirectories as $childDirectory) {
            $childDirectory->resetFullPath();
        }

        foreach ($this->images as $image) {
            $image->resetFullPath();
        }
    }
}
