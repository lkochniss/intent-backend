<?php
/**
 * @package AppBundle\Tests\Controller
 */

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\Category;

/**
 * Class CategoryControllerTest
 */
class CategoryControllerTest extends AbstractControllerTest
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
        parent::setUp();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Category');
        $this->category = $repository->findBy(
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
        $crawler = $this->pageResponse('GET', '/category/create');

        $this->checkIfOneContentExist($crawler, 'input[id="category_name"]');
        $this->checkIfOneContentExist($crawler, 'input[id="category_priority"]');
        $this->checkIfOneContentExist($crawler, 'button[id="category_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/category/%s/edit', $this->category->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="category_name"]');
        $this->checkIfOneContentExist($crawler, 'input[id="category_priority"]');
        $this->checkIfOneContentExist($crawler, 'button[id="category_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/category/%s/show', $this->category->getId()));

        $this->checkIfOneContentExist($crawler, 'button[id="page_publish_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/category/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');

        return null;
    }
}
