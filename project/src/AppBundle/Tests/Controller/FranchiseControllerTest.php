<?php
/**
 * @package AppBundle\Tests\Controller
 */

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\Franchise;

/**
 * Class FranchiseControllerTest
 */
class FranchiseControllerTest extends AbstractControllerTest
{
    /**
     * @var Franchise
     */
    protected $franchise;

    /**
     * @return $this
     */
    public function setUp()
    {
        parent::setUp();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Franchise');
        $this->franchise = $repository->findBy(
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
        $this->pageResponse('GET', '/franchise/create');

        return null;
    }

    /**
     * @return null
     */
    public function testEditPage()
    {
        $this->pageResponse('GET', sprintf('/franchise/%s/edit', $this->franchise->getId()));

        return null;
    }

    /**
     * @return null
     */
    public function testShowPage()
    {
        $this->pageResponse('GET', sprintf('/franchise/%s/edit', $this->franchise->getId()));

        return null;
    }

    /**
     * @return null
     */
    public function testListPage()
    {
        $this->pageResponse('GET', '/franchise/');

        return null;
    }
}
