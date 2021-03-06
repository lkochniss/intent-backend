<?php
/**
 * @package Test\AppBundle\Controller\Content
 */

namespace Test\AppBundle\Controller\Content;

use AppBundle\Entity\Category;
use Test\AppBundle\AbstractWebTest;

/**
 * Class CategoryControllerTest
 */
class CategoryControllerTest extends AbstractWebTest
{
    /**
     * @var Category
     */
    protected $category;

    /**
     * @return $this
     */
    public function setUp()
    {
        $this->setClient('admin', 'admin');
        $this->setEntityManager();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Category');
        $this->category = $repository->findBy(
            array(),
            array(),
            1
        )[0];

        return $this;
    }

    /**
     * @group controller
     * @group category
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/category/create');

        $this->checkIfOneContentExist($crawler, 'input[id="category_name"]');
        $this->checkIfOneContentExist($crawler, 'input[id="category_priority"]');
        $this->checkIfOneContentExist($crawler, 'button[id="category_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="category_saveAndPublish"]');

        return null;
    }

    /**
     * @group controller
     * @group category
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/category/%s/edit', $this->category->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="category_name"]');
        $this->checkIfOneContentExist($crawler, 'input[id="category_priority"]');
        $this->checkIfOneContentExist($crawler, 'button[id="category_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="category_saveAndPublish"]');

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/category/%s/show"]', $this->category->getId()));

        return null;
    }

    /**
     * @group controller
     * @group category
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/category/%s/show', $this->category->getId()));

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/category/%s/edit"]', $this->category->getId()));

        return null;
    }

    /**
     * @group controller
     * @group category
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/category/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/category/create"]');
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/category/%s/edit"]', $this->category->getId()));
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/category/%s/show"]', $this->category->getId()));

        return null;
    }
}
