<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller\AccessDenied;

use AppBundle\Entity\Event;
use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class EventControllerAccessDeniedTest
 */
class EventControllerAccessDeniedTest extends AbstractControllerTest
{
    /**
     * @var Event
     */
    protected $event;

    /**
     * @return $this
     */
    public function setUp()
    {
        parent::setUp();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Event');
        $this->event = $repository->findBy(
            array(),
            array(),
            1
        )[0];

        return $this;
    }

    /**
     * @group controller
     * @group event
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/event/create', 403);

        return null;
    }

    /**
     * @group controller
     * @group event
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/event/%s/edit', $this->event->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group event
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/event/%s/show', $this->event->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group event
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/event/', 403);

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
