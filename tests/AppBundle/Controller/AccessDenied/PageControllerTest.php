<?php
/**
 * @package Test\AppBundle\Controller\AccessDenied
 */

namespace Test\AppBundle\Controller\AccessDenied;

use AppBundle\Entity\Page;
use Test\AppBundle\AbstractWebTest;

/**
 * Class PageControllerTest
 */
class PageControllerTest extends AbstractWebTest
{
    /**
     * @var Page
     */
    protected $page;

    /**
     * @return $this
     */
    public function setUp()
    {
        $this->setClient('0-Permission-User', 'no permission');
        $this->setEntityManager();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Page');
        $this->page = $repository->findBy(
            array(),
            array(),
            1
        )[0];

        return $this;
    }

    /**
     * @group controller
     * @group page
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/page/create', 403);

        return null;
    }

    /**
     * @group controller
     * @group page
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/page/%s/edit', $this->page->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group page
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/page/%s/show', $this->page->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group page
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/page/', 403);

        return null;
    }
}
