<?php
/**
 * @package Test\AppBundle\Controller\AccessAllowed
 */

namespace Test\AppBundle\Controller\AccessAllowed;

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
        $this->setClient('Publishing Editor', 'publishing');
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

        return null;
    }
}
