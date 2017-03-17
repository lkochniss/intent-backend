<?php
/**
 * @package Test\AppBundle\Controller\AccessAllowed
 */

namespace Test\AppBundle\Controller\AccessAllowed;

use AppBundle\Entity\User;
use Test\AppBundle\AbstractWebTest;

/**
 * Class UserControllerTest
 */
class UserControllerTest extends AbstractWebTest
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
        $this->setClient('admin', 'admin');
        $this->setEntityManager();

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
    public function testCreateUser()
    {
        $crawler = $this->pageResponse('GET', '/user/create');

        return null;
    }

    /**
     * @group controller
     * @group user
     * @return null
     */
    public function testEditUser()
    {
        $crawler = $this->pageResponse('GET', sprintf('/user/%s/edit', $this->user->getId()));

        return null;
    }

    /**
     * @group controller
     * @group user
     * @return null
     */
    public function testResetPassword()
    {
        $crawler = $this->pageResponse('GET', sprintf('/user/%s/password', $this->user->getId()));

        return null;
    }

    /**
     * @group controller
     * @group user
     * @return null
     */
    public function testListUser()
    {
        $crawler = $this->pageResponse('GET', '/user/');

        return null;
    }
}
