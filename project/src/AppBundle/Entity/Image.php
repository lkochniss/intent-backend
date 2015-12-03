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
     * @param string $description Set description.
     * @return $this;
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $path Set path.
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        $this->resetFullPath();

        return $this;
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
    public function getParentDirectory()
    {
        return $this->parentDirectory;
    }

    /**
     * @return string
     */
    public function getFullPath()
    {
        return $this->fullPath;
    }

    /**
     * @return string
     */
    public function resetFullPath()
    {
        if (is_null($this->parentDirectory)) {
            $this->fullPath = $this->path;
        } else {
            $this->fullPath = $this->parentDirectory->getFullPath() . '/' . $this->path;
        }

        return $this;
    }

    /**
     * @param Directory $parentDirectory Set parentDirectory.
     * @return $this
     */
    public function setParentDirectory(Directory $parentDirectory)
    {
        $this->parentDirectory = $parentDirectory;

        return $this;
    }

    /**
     * @param UploadedFile|null $file Set UploadFile.
     * @return $this
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getFile()
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

    /**
     * @return null|void
     */
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

        return null;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name . ' ( ' . $this->fullPath . ' )';
    }
}
