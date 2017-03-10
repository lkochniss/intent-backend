<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller\AccessDenied;

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
        $crawler = $this->pageResponse('GET', '/studio/create', 403);

        return null;
    }

    /**
     * @group controller
     * @group studio
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/studio/%s/edit', $this->studio->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group studio
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/studio/%s/show', $this->studio->getId()), 403);

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

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/studio/create"]');
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/studio/%s/edit"]', $this->studio->getId()));
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/studio/%s/show"]', $this->studio->getId()));

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
