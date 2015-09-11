<?php
/**
 * @package AppBundle\Tests\Controller
 */

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\User;

/**
 * Class UserControllerTest
 */
class UserControllerTest extends AbstractControllerTest
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @return $this
     */
    public function setUp()
    {
        parent::setUp();

        $repository = $this->getEntityManager()->getRepository('AppBundle:User');
        $this->user = $repository->findBy(
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
        $this->pageResponse('GET', '/user/create');

        return null;
    }

    /**
     * @return null
     */
    public function testEditPage()
    {
        $this->pageResponse('GET', sprintf('/user/%s/edit', $this->user->getId()));

        return null;
    }

    /**
     * @return null
     */
    public function testShowPage()
    {
        $this->pageResponse('GET', sprintf('/user/%s/edit', $this->user->getId()));

        return null;
    }

    /**
     * @return null
     */
    public function testListPage()
    {
        $this->pageResponse('GET', '/user/');

        return null;
    }
}
