<?php
/**
 * @package Test\AppBundle\Controller\AccessAllowed
 */

namespace Test\AppBundle\Controller\AccessAllowed;

use AppBundle\Entity\Expansion;
use Test\AppBundle\AbstractWebTest;

/**
 * Class ExpansionControllerTest
 */
class ExpansionControllerTest extends AbstractWebTest
{
    /**
     * @var Expansion
     */
    protected $expansion;

    /**
     * @return $this
     */
    public function setUp()
    {
        $this->setClient('Publishing Editor', 'publishing');
        $this->setEntityManager();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Expansion');
        $this->expansion = $repository->findBy(
            array(),
            array(),
            1
        )[0];

        return $this;
    }

    /**
     * @group controller
     * @group expansion
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/expansion/create');

        return null;
    }

    /**
     * @group controller
     * @group expansion
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/expansion/%s/edit', $this->expansion->getId()));

        return null;
    }

    /**
     * @group controller
     * @group expansion
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/expansion/%s/show', $this->expansion->getId()));
        return null;
    }

    /**
     * @group controller
     * @group expansion
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/expansion/');

        return null;
    }
}
