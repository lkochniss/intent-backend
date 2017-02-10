<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller;

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
     * @group controller
     * @group user
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/user/create');

        $this->checkIfOneContentExist($crawler, 'input[id="user_username"]');
        $this->checkIfOneContentExist($crawler, 'input[id="user_email"]');
        $this->checkIfOneContentExist($crawler, 'select[id="user_roles"]');
        $this->checkIfOneContentExist($crawler, 'input[id="user_isActive"]');
        $this->checkIfOneContentExist($crawler, 'button[id="user_submit"]');

        return null;
    }

    /**
     * @group controller
     * @group user
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/user/%s/edit', $this->user->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="user_username"]');
        $this->checkIfOneContentExist($crawler, 'input[id="user_email"]');
        $this->checkIfOneContentExist($crawler, 'select[id="user_roles"]');
        $this->checkIfOneContentExist($crawler, 'input[id="user_isActive"]');
        $this->checkIfOneContentExist($crawler, 'button[id="user_submit"]');

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

        $this->checkIfOneContentExist($crawler, 'input[id="user_password_password_first"]');
        $this->checkIfOneContentExist($crawler, 'input[id="user_password_password_second"]');
        $this->checkIfOneContentExist($crawler, 'button[id="user_password_submit"]');

        return null;
    }

    /**
     * @group controller
     * @group user
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/user/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/user/create"]');
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/user/%s/edit"]', $this->user->getId()));
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/user/%s/delete"]', $this->user->getId()));

        return null;
    }
}
