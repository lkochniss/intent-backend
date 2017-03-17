<?php
/**
 * @package Test\AppBundle\TwigInclude
 */

namespace Test\AppBundle\TwigInclude;

use AppBundle\Entity\Article;
use AppBundle\Entity\User;
use Test\AppBundle\AbstractWebTest;

/**
 * Class AccessAdminTest
 */
class AccessAdminTest extends AbstractWebTest
{
    /**
     * @var User $user
     */
    var $user;

    /**
     * @return $this
     */
    public function setUp()
    {
        $this->setClient('admin', 'admin');
        $this->setEntityManager();

        $this->user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneBy(array('username' => 'admin'));

        return $this;
    }

    /**
     * @group twig
     * @return null
     */
    public function testAdminBar()
    {
        $crawler = $this->pageResponse('GET', '');

        $this->checkIfOneContentExist($crawler, 'a[href="/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/article/create"]');
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/user/%s/password"]', $this->user->getId()));
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/profile/%s/edit"]', $this->user->getId()));
        $this->checkIfOneContentExist($crawler, 'a[href="/logout"]');

        return null;
    }

    /**
     * @group twig
     * @return null
     */
    public function testSidebar()
    {
        $crawler = $this->pageResponse('GET', '');

        /**
         * Sidebar
         */
        $this->checkIfOneContentExist($crawler, 'a[href="/article/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/page/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/category/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/tag/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/event/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/publisher/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/studio/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/franchise/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/game/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/expansion/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/filemanager"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/user/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/profile/"]');

        return null;
    }
}
