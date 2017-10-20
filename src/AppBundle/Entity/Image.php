<?php
/**
 * @package AppBundle\Entity
 */

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Image
 */
class Image extends AbstractModel
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
     *
     * @Assert\NotBlank()
     * @Assert\File(
     *     maxSize = "10Mi",
     *     mimeTypes = {"image/jpeg", "image/png", "image/gif"},
     * )
     */
    private $file;

    /**
     * @param string $name
     * @return $this
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
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
        $this->resetFullPath();
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return Directory
     */
    public function getParentDirectory() : Directory
    {
        return $this->parentDirectory;
    }

    /**
     * @return string
     */
    public function getFullPath() : string
    {
        return $this->fullPath;
    }

    public function resetFullPath()
    {
        if (is_null($this->parentDirectory)) {
            $this->fullPath = $this->path;
        } else {
            $this->fullPath = $this->parentDirectory->getFullPath() . '/' . $this->path;
        }
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
     * @return $this
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * @return UploadedFile
     */
    public function getFile() : UploadedFile
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getAbsolutePath()
    {
        return '/' . $this->getFullPath();
    }

    public function upload()
    {
        if (null === $this->getFile()) {
            return null;
        }

        $this->setPath($this->path . '.' . $this->getFile()->guessExtension());

        $this->getFile()->move(
            $this->parentDirectory->getFullPath(),
            $this->path
        );

        $this->file = null;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->name . ' ( ' . $this->fullPath . ' )';
    }
}
