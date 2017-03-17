<?php
/**
 * @package Test\AppBundle\Controller\AccessDenied
 */

namespace Test\AppBundle\Controller\AccessDenied;

use AppBundle\Entity\Franchise;
use Test\AppBundle\AbstractWebTest;

/**
 * Class FranchiseControllerAccessDeniedTest
 */
class FranchiseControllerAccessDeniedTest extends AbstractWebTest
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
        $this->setClient('0-Permission-User', 'no permission');
        $this->setEntityManager();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Franchise');
        $this->franchise = $repository->findBy(
            array(),
            array(),
            1
        )[0];

        return $this;
    }

    /**
     * @group controller
     * @group franchise
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/franchise/create', 403);

        return null;
    }

    /**
     * @group controller
     * @group franchise
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/franchise/%s/edit', $this->franchise->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group franchise
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/franchise/%s/show', $this->franchise->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group franchise
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/franchise/', 403);

        return null;
    }
}
