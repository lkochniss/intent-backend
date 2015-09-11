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
        $this->pageResponse('GET', '/category/create');

        return null;
    }

    /**
     * @return null
     */
    public function testEditPage()
    {
        $this->pageResponse('GET', sprintf('/category/%s/edit', $this->category->getId()));

        return null;
    }

    /**
     * @return null
     */
    public function testShowPage()
    {
        $this->pageResponse('GET', sprintf('/category/%s/edit', $this->category->getId()));

        return null;
    }

    /**
     * @return null
     */
    public function testListPage()
    {
        $this->pageResponse('GET', '/category/');

        return null;
    }
}
