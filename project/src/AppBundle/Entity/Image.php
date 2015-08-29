<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image
 */
class Image extends AbstractModel
{
    /**
     * @var String
     */
    private $name;

    /**
     * @var String
     */
    private $description;

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
     * @var UploadedFile
     */
    private $file;

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
     * @param String $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        $this->resetFullPath();

        return $this;
    }

    /**
     * @return String
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return Directory
     */
    public function getParentDirectory()
    {
        return $this->parentDirectory;
    }

    /**
     * @return String
     */
    public function getFullPath()
    {
        return $this->fullPath;
    }

    /**
     * @return String
     */
    public function resetFullPath()
    {
        if (is_null($this->parentDirectory)) {
            $this->fullPath = $this->path;
        } else {
            $this->fullPath = $this->parentDirectory->getFullPath().'/'.$this->path;
        }

        return $this;
    }

    /**
     * @param Directory $parentDirectory
     */
    public function setParentDirectory(Directory $parentDirectory)
    {
        $this->parentDirectory = $parentDirectory;
    }

    /**
     * @param UploadedFile|null $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function upload()
    {
        $this->setPath($this->path.'.'.$this->getFile()->guessExtension());
        if (null === $this->getFile()) {
            return;
        }

        $this->getFile()->move(
            $this->parentDirectory->getFullPath(),
            $this->path
        );

        $this->file = null;
    }
}
