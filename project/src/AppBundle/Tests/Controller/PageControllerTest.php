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
        $crawler = $this->pageResponse('GET', '/page/create');

        $this->checkIfOneContentExist($crawler, 'input[id="page_title"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="page_content"]');
        $this->checkIfOneContentExist($crawler, 'button[id="page_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/page/%s/edit', $this->page->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="page_title"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="page_content"]');
        $this->checkIfOneContentExist($crawler, 'button[id="page_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/page/%s/show', $this->page->getId()));

        $this->checkIfOneContentExist($crawler, 'div[id="page_publish_publishAt"]');
        $this->checkIfOneContentExist($crawler, 'button[id="page_publish_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/page/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');

        return null;
    }
}
