<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller\AccessAllowed;

use AppBundle\Entity\Tag;
use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class TagControllerTest
 */
class TagControllerTest extends AbstractControllerTest
{
    /**
     * @var Tag
     */
    protected $tag;

    /**
     * @return $this
     */
    public function setUp()
    {
        parent::setUp();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Tag');
        $this->tag = $repository->findBy(
            array(),
            array(),
            1
        )[0];

        return $this;
    }

    /**
     * @group controller
     * @group tag
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/tag/create');

        return null;
    }

    /**
     * @group controller
     * @group tag
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/tag/%s/edit', $this->tag->getId()));

        return null;
    }

    /**
     * @group controller
     * @group tag
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/tag/%s/show', $this->tag->getId()));

        return null;
    }

    /**
     * @group controller
     * @group tag
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/tag/');
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
