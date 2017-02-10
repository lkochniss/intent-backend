<?php
/**
 * @package Test\AppBundle\Entity
 */

namespace Test\AppBundle\Entity;

use AppBundle\Entity\Expansion;
use AppBundle\Entity\Image;
use AppBundle\Entity\Game;
use AppBundle\Entity\Article;

/**
 * Class ExpansionTest
 */
class ExpansionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @group entity
     * @return null
     */
    public function testEntity()
    {
        $expansion = new Expansion();

        $name = 'Expansion 1';
        $expansion->setName($name);
        $this->assertEquals($expansion->getName(), $name);

        $slug = 'expansion-1';
        $expansion->setSlug($slug);
        $this->assertEquals($expansion->getSlug(), $slug);

        $published = 1;
        $expansion->setPublished($published);
        $this->assertEquals($expansion->isPublished(), $published);

        $expansion->setCreatedAt();
        $this->assertNotEmpty($expansion->getCreatedAt());

        $expansion->setModifiedAt();
        $this->assertNotEmpty($expansion->getModifiedAt());

        $image = $this->getMockBuilder(Image::class)->getMock();

        $expansion->setThumbnail($image);
        $this->assertEquals($expansion->getThumbnail(), $image);

        $expansion->setBackgroundImage($image);
        $this->assertEquals($expansion->getBackgroundImage(), $image);

        $link = '/expansion';
        $expansion->setBackgroundLink($link);
        $this->assertEquals($expansion->getBackgroundLink(), $link);

        $game = $this->getMockBuilder(Game::class)->getMock();
        $expansion->setGame($game);
        $this->assertEquals($expansion->getGame(), $game);

        $article = $this->getMockBuilder(Article::class)->getMock();

        $expansion->addArticle($article);
        $this->assertEquals($expansion->getArticles(), array($article));

        $expansion->removeArticle($article);
        $this->assertEquals($expansion->getArticles(), array());

        return null;
    }
}
