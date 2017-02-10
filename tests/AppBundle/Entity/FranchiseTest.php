<?php
/**
 * @package Test\AppBundle\Entity
 */

namespace Test\AppBundle\Entity;

use AppBundle\Entity\Franchise;
use AppBundle\Entity\Image;
use AppBundle\Entity\Publisher;
use AppBundle\Entity\Studio;
use AppBundle\Entity\Game;
use AppBundle\Entity\Article;

/**
 * Class FranchiseTest
 */
class FranchiseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @group entity
     * @return null
     */
    public function testEntity()
    {
        $franchise = new Franchise();

        $name = 'Franchise 1';
        $franchise->setName($name);
        $this->assertEquals($franchise->getName(), $name);

        $slug = 'franchise-1';
        $franchise->setSlug($slug);
        $this->assertEquals($franchise->getSlug(), $slug);

        $published = 1;
        $franchise->setPublished($published);
        $this->assertEquals($franchise->isPublished(), $published);

        $franchise->setCreatedAt();
        $this->assertNotEmpty($franchise->getCreatedAt());

        $franchise->setModifiedAt();
        $this->assertNotEmpty($franchise->getModifiedAt());

        $image = $this->getMockBuilder(Image::class)->getMock();

        $franchise->setThumbnail($image);
        $this->assertEquals($franchise->getThumbnail(), $image);

        $franchise->setBackgroundImage($image);
        $this->assertEquals($franchise->getBackgroundImage(), $image);

        $link = '/franchise';
        $franchise->setBackgroundLink($link);
        $this->assertEquals($franchise->getBackgroundLink(), $link);

        $publisher = $this->getMockBuilder(Publisher::class)->getMock();
        $franchise->setPublisher($publisher);
        $this->assertEquals($franchise->getPublisher(), $publisher);

        $studio = $this->getMockBuilder(Studio::class)->getMock();
        $franchise->setStudio($studio);
        $this->assertEquals($franchise->getStudio(), $studio);

        $game = $this->getMockBuilder(Game::class)->getMock();

        $franchise->addGame($game);
        $this->assertEquals($franchise->getGames(), array($game));

        $franchise->removeGame($game);
        $this->assertEquals($franchise->getGames(), array());

        $article = $this->getMockBuilder(Article::class)->getMock();

        $franchise->addArticle($article);
        $this->assertEquals($franchise->getArticles(), array($article));

        $franchise->removeArticle($article);
        $this->assertEquals($franchise->getArticles(), array());

        return null;
    }
}
