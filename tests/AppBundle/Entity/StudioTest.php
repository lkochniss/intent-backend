<?php
/**
 * @package Test\AppBundle\Entity
 */

namespace Test\AppBundle\Entity;

use AppBundle\Entity\Game;
use AppBundle\Entity\Image;
use AppBundle\Entity\Publisher;
use AppBundle\Entity\Studio;
use AppBundle\Entity\Franchise;
use AppBundle\Entity\Expansion;
use AppBundle\Entity\Article;

/**
 * Class StudioTest
 * @package Test\AppBundle\Controller
 */
class StudioTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return null
     */
    public function testEntity()
    {
        $studio = new Studio();

        $name = 'Studio 1';
        $studio->setName($name);
        $this->assertEquals($studio->getName(), $name);

        $slug = 'studio-1';
        $studio->setSlug($slug);
        $this->assertEquals($studio->getSlug(), $slug);

        $published = 1;
        $studio->setPublished($published);
        $this->assertEquals($studio->isPublished(), $published);

        $studio->setCreatedAt();
        $this->assertNotEmpty($studio->getCreatedAt());

        $studio->setModifiedAt();
        $this->assertNotEmpty($studio->getModifiedAt());

        $image = $this->getMock(Image::class);

        $studio->setThumbnail($image);
        $this->assertEquals($studio->getThumbnail(), $image);

        $studio->setBackgroundImage($image);
        $this->assertEquals($studio->getBackgroundImage(), $image);

        $link = '/studio';
        $studio->setBackgroundLink($link);
        $this->assertEquals($studio->getBackgroundLink(), $link);

        $franchise = $this->getMock(Franchise::class);

        $studio->addFranchise($franchise);
        $this->assertEquals($studio->getFranchises(), array($franchise));

        $studio->removeFranchise($franchise);
        $this->assertEquals($studio->getFranchises(), array());

        $game = $this->getMock(Game::class);

        $studio->addGame($game);
        $this->assertEquals($studio->getGames(), array($game));

        $studio->removeGame($game);
        $this->assertEquals($studio->getGames(), array());

        $article = $this->getMock(Article::class);

        $studio->addArticle($article);
        $this->assertEquals($studio->getArticles(), array($article));

        $studio->removeArticle($article);
        $this->assertEquals($studio->getArticles(), array());

        return null;
    }
}
