<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller\AccessAllowed;

use AppBundle\Entity\Studio;
use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class StudioControllerTest
 */
class StudioControllerTest extends AbstractControllerTest
{
    /**
     * @var Studio
     */
    protected $studio;

    /**
     * @return $this
     */
    public function setUp()
    {
        parent::setUp();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Studio');
        $this->studio = $repository->findBy(
            array(),
            array(),
            1
        )[0];

        return $this;
    }

    /**
     * @group controller
     * @group studio
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/studio/create');

        return null;
    }

    /**
     * @group controller
     * @group studio
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/studio/%s/edit', $this->studio->getId()));

        return null;
    }

    /**
     * @group controller
     * @group studio
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/studio/%s/show', $this->studio->getId()));

        return null;
    }

    /**
     * @group controller
     * @group studio
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/studio/');

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
