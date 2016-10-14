<?php
/**
 * @package Test\AppBundle\Entity
 */

namespace Test\AppBundle\Entity;

use AppBundle\Entity\Page;

/**
 * Class PageTest
 */
class PageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return null
     */
    public function testEntity()
    {
        $page = new Page();

        $title = 'New Page';
        $page->setTitle($title);
        $this->assertEquals($page->getTitle(), $title);

        $slug = 'new-page';
        $page->setSlug($slug);
        $this->assertEquals($page->getSlug(), $slug);

        $content = 'Lorem Ipsum';
        $page->setContent($content);
        $this->assertEquals($page->getContent(), $content);

        $page->setCreatedAt();
        $this->assertNotEmpty($page->getCreatedAt());

        $page->setModifiedAt();
        $this->assertNotEmpty($page->getModifiedAt());

        $published = 1;
        $page->setPublished($published);
        $this->assertEquals($page->isPublished(), $published);

        return null;
    }
}
