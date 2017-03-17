<?php
/**
 * @package Test\AppBundle\Controller\AccessAllowed
 */

namespace Test\AppBundle\Controller\AccessAllowed;

use AppBundle\Entity\Profile;
use Test\AppBundle\AbstractWebTest;

/**
 * Class ProfileControllerTest
 */
class ProfileControllerTest extends AbstractWebTest
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
        $this->setClient('Publishing Editor', 'publishing');
        $this->setEntityManager();

        $user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneBy(
            array('username' => 'Publishing Editor')
        );

        $this->profile = $user->getProfile();

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
}
