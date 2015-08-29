<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Directory
 */
class Directory extends AbstractModel
{
    /**
     * @var String
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
     * @var  ArrayCollection
     */
    private $images;

    /**
     * @var ArrayCollection;
     */
    private $childDirectories;

    function __construct()
    {
        $this->childDirectories = array();
        $this->images = array();
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return String
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        $this->updateFullpath();

        return $this;
    }

    public function updateFullpath()
    {
        $this->resetFullPath();
        foreach ($this->childDirectories as $childDirectory) {
            $childDirectory->resetFullPath();
        }

        foreach ($this->images as $image) {
            $image->resetFullPath();
        }

    }

    /**
     * @return String
     */
    public function resetFullPath()
    {
        if ($this->isRootNode()) {
            $this->fullPath = $this->path;

            return $this;
        }

        $this->fullPath = $this->parentDirectory->getFullPath().'/'.$this->path;

        return $this;
    }

    /**
     * @return String
     */
    public function getFullPath()
    {
        return $this->fullPath;
    }

    /**
     * @param null $parentDirectory
     * @return $this
     */
    public function setParentDirectory($parentDirectory = null)
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
     * @param Directory $directory
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

    public function removeChildDirectory(Directory $directory)
    {
        $this->childDirectories->remove($directory);

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
     * @param Image $image
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

    public function removeImages(Image $image)
    {
        $this->images->remove($image);

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
     * @return bool
     */
    public function isRootNode()
    {
        if (is_null($this->parentDirectory)) {
            return true;
        }

        return false;
    }

    /**
     * @return String
     */
    function __toString()
    {
        return $this->path;
    }


}
