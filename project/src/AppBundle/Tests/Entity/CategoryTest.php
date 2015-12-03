<?php
/**
 * @package AppBundle\Tests\Entity
 */

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Category;

/**
 * Class CategoryTest
 * @package AppBundle\Tests\Controller
 */
class CategoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return null
     */
    public function testEntity()
    {
        $category = new Category();

        $name = 'New Category';
        $category->setName($name);
        $this->assertEquals($category->getName(), $name);

        $slug = 'new-category';
        $category->setSlug($slug);
        $this->assertEquals($category->getSlug(), $slug);

        $priority = 1;
        $category->setPriority($priority);
        $this->assertEquals($category->getPriority(), $priority);

        $published = 1;
        $category->setPublished($published);
        $this->assertEquals($category->isPublished(), $published);

        $category->setCreatedAt();
        $this->assertNotEmpty($category->getCreatedAt());

        $category->setModifiedAt();
        $this->assertNotEmpty($category->getModifiedAt());

        return null;
    }
}
