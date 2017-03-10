<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller\AccessAllowed;

use AppBundle\Entity\Expansion;
use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class ExpansionControllerTest
 */
class ExpansionControllerTest extends AbstractControllerTest
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
        parent::setUp();

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

    /**
     * @return string
     */
    protected function getUsername()
    {
        return 'Publishing Editor';
    }
    /**
     * @return string
     */
    protected function getPassword()
    {
        return 'publishing';
    }
}
