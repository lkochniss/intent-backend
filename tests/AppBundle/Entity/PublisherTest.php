<?php
/**
 * @package Test\AppBundle\Entity
 */

namespace Test\AppBundle\Entity;

use AppBundle\Entity\Image;
use AppBundle\Entity\Publisher;
use AppBundle\Entity\Franchise;
use AppBundle\Entity\Article;

/**
 * Class PublisherTest
 */
class PublisherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @group entity
     * @return null
     */
    public function testEntity()
    {
        $publisher = new Publisher();

        $name = 'Publisher 1';
        $publisher->setName($name);
        $this->assertEquals($publisher->getName(), $name);

        $slug = 'publisher-1';
        $publisher->setSlug($slug);
        $this->assertEquals($publisher->getSlug(), $slug);

        $published = 1;
        $publisher->setPublished($published);
        $this->assertEquals($publisher->isPublished(), $published);

        $publisher->setCreatedAt();
        $this->assertNotEmpty($publisher->getCreatedAt());

        $publisher->setModifiedAt();
        $this->assertNotEmpty($publisher->getModifiedAt());

        $image = $this->getMockBuilder(Image::class)->getMock();

        $publisher->setThumbnail($image);
        $this->assertEquals($publisher->getThumbnail(), $image);

        $publisher->setBackgroundImage($image);
        $this->assertEquals($publisher->getBackgroundImage(), $image);

        $link = '/publisher';
        $publisher->setBackgroundLink($link);
        $this->assertEquals($publisher->getBackgroundLink(), $link);

        $franchise = $this->getMockBuilder(Franchise::class)->getMock();

        $publisher->addFranchise($franchise);
        $this->assertEquals($publisher->getFranchises(), array($franchise));

        $publisher->removeFranchise($franchise);
        $this->assertEquals($publisher->getFranchises(), array());

        $article = $this->getMockBuilder(Article::class)->getMock();

        $publisher->addArticle($article);
        $this->assertEquals($publisher->getArticles(), array($article));

        $publisher->removeArticle($article);
        $this->assertEquals($publisher->getArticles(), array());

        return null;
    }
}
