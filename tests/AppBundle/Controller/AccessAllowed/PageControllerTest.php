<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller\AccessAllowed;

use AppBundle\Entity\Page;
use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class PageControllerTest
 */
class PageControllerTest extends AbstractControllerTest
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
        parent::setUp();

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
        $crawler = $this->pageResponse('GET', '/page/create');

        return null;
    }

    /**
     * @group controller
     * @group page
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/page/%s/edit', $this->page->getId()));

        return null;
    }

    /**
     * @group controller
     * @group page
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/page/%s/show', $this->page->getId()));

        return null;
    }

    /**
     * @group controller
     * @group page
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/page/');

        return null;
    }

    /**
     * @return string
     */
    protected function getUsername()
    {
        return 'admin';
    }
    /**
     * @return string
     */
    protected function getPassword()
    {
        return 'admin';
    }
}
