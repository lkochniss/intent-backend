<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller\AccessDenied;

use AppBundle\Entity\Article;
use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class ArticleControllerAccessDeniedTest
 */
class ArticleControllerAccessDeniedTest extends AbstractControllerTest
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
        $crawler = $this->pageResponse('GET', '/article/create', 403);
        return null;
    }

    /**
     * @group controller
     * @group article
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/article/%s/edit', $this->article->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group article
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/article/%s/show', $this->article->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group article
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/article/', 403);

        return null;
    }

    /**
     * @return string
     */
    protected function getUsername()
    {
        return '0-Permission-User';
    }
    /**
     * @return string
     */
    protected function getPassword()
    {
        return 'no permission';
    }
}
