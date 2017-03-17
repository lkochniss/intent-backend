<?php
/**
 * @package Test\AppBundle\Controller\AccessAllowed
 */

namespace Test\AppBundle\Controller\AccessAllowed;

use AppBundle\Entity\Franchise;
use Test\AppBundle\AbstractWebTest;

/**
 * Class FranchiseControllerTest
 */
class FranchiseControllerTest extends AbstractWebTest
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
        $this->setClient('Publishing Editor', 'publishing');
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
        $crawler = $this->pageResponse('GET', '/franchise/create');

        return null;
    }

    /**
     * @group controller
     * @group franchise
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/franchise/%s/edit', $this->franchise->getId()));

        return null;
    }

    /**
     * @group controller
     * @group franchise
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/franchise/%s/show', $this->franchise->getId()));

        return null;
    }

    /**
     * @group controller
     * @group franchise
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/franchise/');

        return null;
    }
}
