<?php
/**
 * @package Test\AppBundle\Entity
 */

namespace Test\AppBundle\Entity;

use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use AppBundle\Entity\Event;
use AppBundle\Entity\Expansion;
use AppBundle\Entity\Franchise;
use AppBundle\Entity\Game;
use AppBundle\Entity\Image;
use AppBundle\Entity\Publisher;
use AppBundle\Entity\Studio;
use AppBundle\Entity\Tag;
use AppBundle\Entity\User;

/**
 * Class ArticleTest
 */
class ArticleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return null
     */
    public function testEntity()
    {
        $article = new Article();

        $title = 'New Article';
        $article->setTitle($title);
        $this->assertEquals($article->getTitle(), $title);

        $slug = 'new-article';
        $article->setSlug($slug);
        $this->assertEquals($article->getSlug(), $slug);

        $content = 'Lorem Ipsum';
        $article->setContent($content);
        $this->assertEquals($article->getContent(), $content);

        $slideshow = 1;
        $article->setSlideshow($slideshow);
        $this->assertEquals($article->isSlideshow(), $slideshow);


        $category = $this->getMockBuilder(Category::class)->getMock();
        $article->setCategory($category);
        $this->assertEquals($article->getCategory(), $category);

        $event = $this->getMockBuilder(Event::class)->getMock();
        $article->setEvent($event);
        $this->assertEquals($article->getEvent(), $event);

        $user = $this->getMockBuilder(User::class)->getMock();

        $article->setCreatedBy($user);
        $this->assertEquals($article->getCreatedBy(), $user);

        $article->setModifiedBy($user);
        $this->assertEquals($article->getModifiedBy(), $user);

        $article->setCreatedAt();
        $this->assertNotEmpty($article->getCreatedAt());

        $article->setModifiedAt();
        $this->assertNotEmpty($article->getModifiedAt());

        $published = 1;
        $article->setPublished($published);
        $this->assertEquals($article->isPublished(), $published);

        $now = new \DateTime();
        $article->setPublishAt($now);
        $this->assertEquals($article->getPublishAt(), $now);

        $image = $this->getMockBuilder(Image::class)->getMock();
        $article->setThumbnail($image);
        $this->assertEquals($article->getThumbnail(), $image);

        $tag = $this->getMockBuilder(Tag::class)->getMock();
        $article->addTag($tag);
        $this->assertEquals($article->getTags(), array($tag));

        $article->removeTag($tag);
        $this->assertEquals($article->getTags(), array());

        return null;
    }

    /**
     * @return null
     */
    public function testPossibleRelatedEntities()
    {
        $article = new Article();

        $publisher = $this->getMockBuilder(Publisher::class)->getMock();
        $article->setRelated($publisher);
        $this->assertEquals($article->getRelated(), $publisher);

        $studio = $this->getMockBuilder(Studio::class)->getMock();
        $article->setRelated($studio);
        $this->assertEquals($article->getRelated(), $studio);

        $franchise = $this->getMockBuilder(Franchise::class)->getMock();
        $article->setRelated($franchise);
        $this->assertEquals($article->getRelated(), $franchise);

        $game = $this->getMockBuilder(Game::class)->getMock();
        $article->setRelated($game);
        $this->assertEquals($article->getRelated(), $game);

        $expansion = $this->getMockBuilder(Expansion::class)->getMock();
        $article->setRelated($expansion);
        $this->assertEquals($article->getRelated(), $expansion);

        return null;
    }
}
