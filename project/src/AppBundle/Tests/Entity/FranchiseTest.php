<?php
/**
 * @package AppBundle\Tests\Entity
 */

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Franchise;
use AppBundle\Entity\Image;
use AppBundle\Entity\Publisher;
use AppBundle\Entity\Studio;
use AppBundle\Entity\Game;
use AppBundle\Entity\Article;

/**
 * Class FranchiseTest
 * @package AppBundle\Tests\Controller
 */
class FranchiseTest extends \PHPUnit_Framework_TestCase
{
    /**
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

        $image = $this->getMock(Image::class);

        $franchise->setThumbnail($image);
        $this->assertEquals($franchise->getThumbnail(), $image);

        $franchise->setBackgroundImage($image);
        $this->assertEquals($franchise->getBackgroundImage(), $image);

        $link = '/franchise';
        $franchise->setBackgroundLink($link);
        $this->assertEquals($franchise->getBackgroundLink(), $link);

        $publisher = $this->getMock(Publisher::class);
        $franchise->setPublisher($publisher);
        $this->assertEquals($franchise->getPublisher(), $publisher);

        $studio = $this->getMock(Studio::class);
        $franchise->setStudio($studio);
        $this->assertEquals($franchise->getStudio(), $studio);

        $game = $this->getMock(Game::class);

        $franchise->addGame($game);
        $this->assertEquals($franchise->getGames(), array($game));

        $franchise->removeGame($game);
        $this->assertEquals($franchise->getGames(), array());

        $article = $this->getMock(Article::class);

        $franchise->addArticle($article);
        $this->assertEquals($franchise->getArticles(), array($article));

        $franchise->removeArticle($article);
        $this->assertEquals($franchise->getArticles(), array());

        return null;
    }
}
