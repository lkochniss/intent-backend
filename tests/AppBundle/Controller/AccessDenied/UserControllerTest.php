<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller\AccessDenied;

use AppBundle\Entity\User;
use Test\AppBundle\Controller\AbstractControllerTest;

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
     * @group controller
     * @group user
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/user/create', 403);

        return null;
    }

    /**
     * @group controller
     * @group user
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/user/%s/edit', $this->user->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group user
     * @return null
     */
    public function testResetPassword()
    {
        $crawler = $this->pageResponse('GET', sprintf('/user/%s/password', $this->user->getId()), 403);
        return null;
    }

    /**
     * @group controller
     * @group user
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/user/', 403);

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
