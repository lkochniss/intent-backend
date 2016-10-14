<?php
/**
 * @package Test\AppBundle\Entity
 */

namespace Test\AppBundle\Entity;

use AppBundle\Entity\Game;
use AppBundle\Entity\Image;
use AppBundle\Entity\Studio;
use AppBundle\Entity\Franchise;
use AppBundle\Entity\Expansion;
use AppBundle\Entity\Article;

/**
 * Class GameTest
 */
class GameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return null
     */
    public function testEntity()
    {
        $game = new Game();

        $name = 'Game 1';
        $game->setName($name);
        $this->assertEquals($game->getName(), $name);

        $slug = 'game-1';
        $game->setSlug($slug);
        $this->assertEquals($game->getSlug(), $slug);

        $published = 1;
        $game->setPublished($published);
        $this->assertEquals($game->isPublished(), $published);

        $game->setCreatedAt();
        $this->assertNotEmpty($game->getCreatedAt());

        $game->setModifiedAt();
        $this->assertNotEmpty($game->getModifiedAt());

        $image = $this->getMock(Image::class);

        $game->setThumbnail($image);
        $this->assertEquals($game->getThumbnail(), $image);

        $game->setBackgroundImage($image);
        $this->assertEquals($game->getBackgroundImage(), $image);

        $link = '/game';
        $game->setBackgroundLink($link);
        $this->assertEquals($game->getBackgroundLink(), $link);

        $studio = $this->getMock(Studio::class);
        $game->setStudio($studio);
        $this->assertEquals($game->getStudio(), $studio);

        $franchise = $this->getMock(Franchise::class);
        $game->setFranchise($franchise);
        $this->assertEquals($game->getFranchise(), $franchise);

        $expansion = $this->getMock(Expansion::class);

        $game->addExpansion($expansion);
        $this->assertEquals($game->getExpansions(), array($expansion));

        $game->removeExpansion($expansion);
        $this->assertEquals($game->getExpansions(), array());

        $article = $this->getMock(Article::class);

        $game->addArticle($article);
        $this->assertEquals($game->getArticles(), array($article));

        $game->removeArticle($article);
        $this->assertEquals($game->getArticles(), array());

        return null;
    }
}
