<?php
/**
 * @package AppBundle\Tests\Controller
 */

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\Page;

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
     * @return null
     */
    public function testCreatePage()
    {
        $this->pageResponse('GET', '/page/create');

        return null;
    }

    /**
     * @return null
     */
    public function testEditPage()
    {
        $this->pageResponse('GET', sprintf('/page/%s/edit', $this->page->getId()));

        return null;
    }

    /**
     * @return null
     */
    public function testShowPage()
    {
        $this->pageResponse('GET', sprintf('/page/%s/edit', $this->page->getId()));

        return null;
    }

    /**
     * @return null
     */
    public function testListPage()
    {
        $this->pageResponse('GET', '/page/');

        return null;
    }
}
