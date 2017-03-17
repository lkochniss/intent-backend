<?php
/**
 * @package Test\AppBundle\Controller\AccessDenied
 */

namespace Test\AppBundle\Controller\AccessDenied;

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
        $this->setClient('0-Permission-User', 'no permission');
        $this->setEntityManager();

        $this->user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneBy(
            array('username' => 'Writing-Editor')
        );

        return $this;
    }

    /**
     * @group controller
     * @group user
     * @return null
     */
    public function testCreateUser()
    {
        $crawler = $this->pageResponse('GET', '/user/create', 403);

        return null;
    }

    /**
     * @group controller
     * @group user
     * @return null
     */
    public function testEditUser()
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
    public function testListUser()
    {
        $crawler = $this->pageResponse('GET', '/user/', 403);

        return null;
    }
}
