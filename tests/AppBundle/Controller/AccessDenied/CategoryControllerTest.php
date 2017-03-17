<?php
/**
 * @package Test\AppBundle\Controller\AccessDenied
 */

namespace Test\AppBundle\Controller\AccessDenied;

use AppBundle\Entity\Category;
use Test\AppBundle\AbstractWebTest;

/**
 * Class CategoryControllerAccessDeniedTest
 */
class CategoryControllerAccessDeniedTest extends AbstractWebTest
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
        $this->setClient('0-Permission-User', 'no permission');
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
}
