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
        $this->checkIfOneContentExist($crawler, 'button[id="page_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="page_saveAndPublish"]');

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
        $this->checkIfOneContentExist($crawler, 'button[id="page_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="page_saveAndPublish"]');

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/page/%s/show"]', $this->page->getId()));

        return null;
    }

    /**
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/page/%s/show', $this->page->getId()));

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/page/%s/edit"]', $this->page->getId()));

        return null;
    }

    /**
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/page/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/page/%s/edit"]', $this->page->getId()));
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/page/%s/show"]', $this->page->getId()));

        return null;
    }
}
