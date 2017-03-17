<?php
/**
 * @package Test\AppBundle\Controller\AccessDenied
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
        $this->setClient('0-Permission-User', 'no permission');
        $this->setEntityManager();

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
        $crawler = $this->pageResponse('GET', '/studio/', 403);

        return null;
    }
}
