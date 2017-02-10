<?php
/**
 * @package Test\AppBundle\Entity
 */

namespace Test\AppBundle\Entity;

use AppBundle\Entity\Event;
use AppBundle\Entity\Image;
use AppBundle\Entity\Article;

/**
 * Class EventTest
 */
class EventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @group entity
     * @group event
     * @return null
     */
    public function testEntity()
    {
        $event = new Event();

        $name = 'Event';
        $event->setName($name);
        $this->assertEquals($event->getName(), $name);

        $slug = 'event';
        $event->setSlug($slug);
        $this->assertEquals($event->getSlug(), $slug);

        $description = 'description';
        $event->setDescription($description);
        $this->assertEquals($event->getDescription(), $description);

        $image = $this->getMockBuilder(Image::class)->getMock();
        $event->setThumbnail($image);
        $event->setBackgroundImage($image);
        $this->assertEquals($event->getThumbnail(), $image);
        $this->assertEquals($event->getBackgroundImage(), $image);

        $link = '/page';
        $event->setBackgroundLink($link);
        $this->assertEquals($event->getBackgroundLink(), $link);

        $event->setCreatedAt();
        $this->assertNotEmpty($event->getCreatedAt());

        $event->setModifiedAt();
        $this->assertNotEmpty($event->getModifiedAt());

        $now = new \DateTime();

        $event->setStartAt($now);
        $this->assertEquals($event->getStartAt(), $now);

        $event->setEndAt($now);
        $this->assertEquals($event->getEndAt(), $now);

        $published = 1;
        $event->setPublished($published);
        $this->assertEquals($event->isPublished(), $published);

        $article = $this->getMockBuilder(Article::class)->getMock();
        $event->addArticle($article);
        $this->assertEquals($event->getArticles(), array($article));

        $event->removeArticle($article);
        $this->assertEquals($event->getArticles(), array());

        return null;
    }
}
