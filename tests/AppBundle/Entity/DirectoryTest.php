<?php
/**
 * @package Test\AppBundle\Entity
 */

namespace Test\AppBundle\Entity;

use AppBundle\Entity\Directory;

/**
 * Class DirectoryTest
 * @package Test\AppBundle\Controller
 */
class DirectoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return null
     */
    public function testEntity()
    {
        $directory = new Directory();

        $name = 'Directory';
        $directory->setName($name);
        $this->assertEquals($directory->getName(), $name);

        $path = 'Publisher';
        $directory->setPath($path);
        $this->assertEquals($directory->getPath(), $path);

        $parentDirectory = new Directory();
        $parentDirectory->setPath('upload');
        $directory->setParentDirectory($parentDirectory);
        $this->assertEquals($directory->getParentDirectory(), $parentDirectory);

        $directory->resetFullPath();
        $this->assertEquals($directory->getFullPath(), 'upload/' . $path);

        return null;
    }
}
