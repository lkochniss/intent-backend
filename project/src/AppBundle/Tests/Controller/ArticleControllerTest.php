<?php
/**
 * @package AppBundle\Tests\Controller
 */

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\Article;

/**
 * Class ArticleControllerTest
 */
class ArticleControllerTest extends AbstractControllerTest
{
    /**
     * @var Article
     */
    protected $article;

    /**
     * @return $this
     */
    public function setUp()
    {
        parent::setUp();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Article');
        $this->article = $repository->findBy(
            array(),
            array(),
            1
        )[0];

        return $this;
    }

    /**
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/article/create');

        $this->checkIfOneContentExist($crawler, 'input[id="article_title"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="article_content"]');
        $this->checkIfOneContentExist($crawler, 'select[id="article_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'select[id="article_related"]');
        $this->checkIfOneContentExist($crawler, 'select[id="article_category"]');
        $this->checkIfOneContentExist($crawler, 'select[id="article_event"]');
        $this->checkIfOneContentExist($crawler, 'input[id="article_slideshow"]');
        $this->checkIfOneContentExist($crawler, 'button[id="article_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/article/%s/edit', $this->article->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="article_title"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="article_content"]');
        $this->checkIfOneContentExist($crawler, 'select[id="article_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'select[id="article_related"]');
        $this->checkIfOneContentExist($crawler, 'select[id="article_category"]');
        $this->checkIfOneContentExist($crawler, 'select[id="article_event"]');
        $this->checkIfOneContentExist($crawler, 'input[id="article_slideshow"]');
        $this->checkIfOneContentExist($crawler, 'button[id="article_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/article/%s/show', $this->article->getId()));

        $this->checkIfOneContentExist($crawler, 'div[id="article_publish_publishAt"]');
        $this->checkIfOneContentExist($crawler, 'button[id="article_publish_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/article/');

        $this->checkIfOneContentExist($crawler, 'table');

        return null;
    }
}
