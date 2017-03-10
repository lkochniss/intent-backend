<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller\AccessDenied;

use AppBundle\Entity\Category;
use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class CategoryControllerAccessDeniedTest
 */
class CategoryControllerAccessDeniedTest extends AbstractControllerTest
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
     * @group controller
     * @group category
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/category/create', 403);

        return null;
    }

    /**
     * @group controller
     * @group category
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/category/%s/edit', $this->category->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group category
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/category/%s/show', $this->category->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group category
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/category/', 403);

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
