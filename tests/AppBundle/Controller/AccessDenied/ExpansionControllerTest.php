<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller\AccessDenied;

use AppBundle\Entity\Expansion;
use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class ExpansionControllerAccessDeniedTest
 */
class ExpansionControllerAccessDeniedTest extends AbstractControllerTest
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
        $crawler = $this->pageResponse('GET', '/expansion/create', 403);

        return null;
    }

    /**
     * @group controller
     * @group expansion
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/expansion/%s/edit', $this->expansion->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group expansion
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/expansion/%s/show', $this->expansion->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group expansion
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/expansion/', 403);

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
