<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller\AccessAllowed;

use AppBundle\Entity\Article;
use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class ArticleControllerTest
 */
class ArticleController extends AbstractControllerTest
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
     * @group controller
     * @group article
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/article/create');
        return null;
    }

    /**
     * @group controller
     * @group article
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/article/%s/edit', $this->article->getId()));

        return null;
    }

    /**
     * @group controller
     * @group article
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/article/%s/show', $this->article->getId()));

        return null;
    }

    /**
     * @group controller
     * @group article
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/article/');

        return null;
    }

    /**
     * @return string
     */
    protected function getUsername()
    {
        return 'Publishing Editor';
    }
    /**
     * @return string
     */
    protected function getPassword()
    {
        return 'publishing';
    }
}
