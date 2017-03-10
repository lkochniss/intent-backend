<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller\AccessAllowed;

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
