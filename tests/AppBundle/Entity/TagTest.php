<?php
/**
 * @package Test\AppBundle\Entity
 */

namespace Test\AppBundle\Entity;

use AppBundle\Entity\Article;
use AppBundle\Entity\Tag;

/**
 * Class TagTest
 * @package Test\AppBundle\Controller
 */
class TagTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return null
     */
    public function testEntity()
    {
        $tag = new Tag();

        $name = 'Tag 1';
        $tag->setName($name);
        $this->assertEquals($tag->getName(), $name);

        $slug = 'tag-1';
        $tag->setSlug($slug);
        $this->assertEquals($tag->getSlug(), $slug);

        $published = 1;
        $tag->setPublished($published);
        $this->assertEquals($tag->isPublished(), $published);

        $tag->setCreatedAt();
        $this->assertNotEmpty($tag->getCreatedAt());

        $tag->setModifiedAt();
        $this->assertNotEmpty($tag->getModifiedAt());

        $article = $this->getMock(Article::class);

        $tag->addArticle($article);
        $this->assertEquals($tag->getArticles(), array($article));

        $tag->removeArticle($article);
        $this->assertEquals($tag->getArticles(), array());

        return null;
    }
}
