<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller\Content;

use AppBundle\Entity\Profile;
use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class ProfileControllerTest
 */
class ProfileControllerTest extends AbstractControllerTest
{
    /**
     * @var Profile
     */
    protected $profile;

    /**
     * @return $this
     */
    public function setUp()
    {
        parent::setUp();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Profile');
        $this->profile = $repository->findBy(
            array(),
            array(),
            1
        )[0];

        return $this;
    }

    /**
     * @group controller
     * @group profile
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/profile/create');

        $this->checkIfOneContentExist($crawler, 'input[id="profile_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="profile_description"]');
        $this->checkIfOneContentExist($crawler, 'button[id="profile_submit"]');

        return null;
    }

    /**
     * @group controller
     * @group profile
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/profile/%s/edit', $this->profile->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="profile_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="profile_description"]');
        $this->checkIfOneContentExist($crawler, 'button[id="profile_submit"]');

        return null;
    }

    /**
     * @group controller
     * @group profile
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/profile/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');
        $this->checkIfContentExist($crawler, sprintf('a[href="/profile/%s/edit"]', $this->profile->getId()));

        return null;
    }

    /**
     * @return string
     */
    protected function getUsername()
    {
        return 'admin';
    }

    /**
     * @return string
     */
    protected function getPassword()
    {
        return 'admin';
    }
}
