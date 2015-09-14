<?php
/**
 * @package AppBundle\Tests\Controller
 */

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\Event;

/**
 * Class EventControllerTest
 */
class EventControllerTest extends AbstractControllerTest
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
        $this->checkIfOneContentExist($crawler, 'button[id="event_submit"]');

        return null;
    }

    /**
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
        $this->checkIfOneContentExist($crawler, 'button[id="event_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/event/%s/show', $this->event->getId()));

        $this->checkIfOneContentExist($crawler, 'button[id="event_publish_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/event/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/event/create"]');

        return null;
    }
}
