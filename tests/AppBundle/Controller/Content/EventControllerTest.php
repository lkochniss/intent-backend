<?php
/**
 * @package Test\AppBundle\Controller\Content
 */

namespace Test\AppBundle\Controller\Content;

use AppBundle\Entity\Event;
use Test\AppBundle\AbstractWebTest;

/**
 * Class EventControllerTest
 */
class EventControllerTest extends AbstractWebTest
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
        $this->setClient('admin', 'admin');
        $this->setEntityManager();

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
        $crawler = $this->pageResponse('GET', '/event/create');

        $this->checkIfOneContentExist($crawler, 'input[id="event_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="event_description"]');
        $this->checkIfOneContentExist($crawler, 'select[id="event_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'div[id="event_startAt"]');
        $this->checkIfOneContentExist($crawler, 'div[id="event_endAt"]');
        $this->checkIfOneContentExist($crawler, 'select[id="event_background_image"]');
        $this->checkIfOneContentExist($crawler, 'button[id="event_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="event_saveAndPublish"]');

        return null;
    }

    /**
     * @group controller
     * @group event
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/event/%s/edit', $this->event->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="event_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="event_description"]');
        $this->checkIfOneContentExist($crawler, 'select[id="event_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'div[id="event_startAt"]');
        $this->checkIfOneContentExist($crawler, 'div[id="event_endAt"]');
        $this->checkIfOneContentExist($crawler, 'select[id="event_background_image"]');
        $this->checkIfOneContentExist($crawler, 'button[id="event_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="event_saveAndPublish"]');

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/event/%s/show"]', $this->event->getId()));

        return null;
    }

    /**
     * @group controller
     * @group event
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/event/%s/show', $this->event->getId()));

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/event/%s/edit"]', $this->event->getId()));

        return null;
    }

    /**
     * @group controller
     * @group event
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/event/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/event/create"]');
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/event/%s/edit"]', $this->event->getId()));
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/event/%s/show"]', $this->event->getId()));

        return null;
    }
}
