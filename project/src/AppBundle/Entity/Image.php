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
    private $fileName;

    /**
     * @var String
     */
    private $fileExtension;

    /**
     * @var UploadedFile
     */
    private $uploadedFile;

    /**
     * @param $fileName
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return String
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param $fileExtension
     * @return $this
     */
    public function setFileExtension($fileExtension)
    {
        $this->fileExtension = $fileExtension;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileExtension()
    {
        return $this->fileExtension;
    }

    /**
     * @return UploadedFile
     */
    public function getUploadedFile()
    {
        return $this->uploadedFile;
    }

    /**
     * @param UploadedFile|null $uploadedFile
     */
    public function setUploadedFile($uploadedFile = null)
    {
        $this->uploadedFile = $uploadedFile;
    }
}
