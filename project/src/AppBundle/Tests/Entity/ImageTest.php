<?php
/**
 * @package AppBundle\Tests\Entity
 */

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Directory;
use AppBundle\Entity\Image;

/**
 * Class ImageTest
 * @package AppBundle\Tests\Controller
 */
class ImageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return null
     */
    public function testEntity()
    {
        $image = new Image();

        $name = 'Image';
        $image->setName($name);
        $this->assertEquals($image->getName(), $name);

        $path = 'Image.png';
        $image->setPath($path);
        $this->assertEquals($image->getPath(), $path);

        $parentDirectory = new Directory();
        $parentDirectory->setPath('upload');
        $image->setParentDirectory($parentDirectory);
        $this->assertEquals($image->getParentDirectory(), $parentDirectory);

        $image->resetFullPath();
        $this->assertEquals($image->getFullPath(), 'upload/' . $path);

        return null;
    }
}
