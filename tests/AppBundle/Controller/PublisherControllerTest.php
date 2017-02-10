<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller;

use AppBundle\Entity\Publisher;

/**
 * Class PublisherControllerTest
 */
class PublisherControllerTest extends AbstractControllerTest
{
    /**
     * @var Publisher
     */
    protected $publisher;

    /**
     * @return $this
     */
    public function setUp()
    {
        parent::setUp();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Publisher');
        $this->publisher = $repository->findBy(
            array(),
            array(),
            1
        )[0];

        return $this;
    }

    /**
     * @group controller
     * @group publisher
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/publisher/create');

        $this->checkIfOneContentExist($crawler, 'input[id="publisher_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="publisher_description"]');
        $this->checkIfOneContentExist($crawler, 'select[id="publisher_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'select[id="publisher_background_image"]');
        $this->checkIfOneContentExist($crawler, 'button[id="publisher_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="publisher_saveAndPublish"]');

        return null;
    }

    /**
     * @group controller
     * @group publisher
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/publisher/%s/edit', $this->publisher->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="publisher_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="publisher_description"]');
        $this->checkIfOneContentExist($crawler, 'select[id="publisher_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'select[id="publisher_background_image"]');
        $this->checkIfOneContentExist($crawler, 'button[id="publisher_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="publisher_saveAndPublish"]');

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/publisher/%s/show"]', $this->publisher->getId()));

        return null;
    }

    /**
     * @group controller
     * @group publisher
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/publisher/%s/show', $this->publisher->getId()));

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/publisher/%s/edit"]', $this->publisher->getId()));

        return null;
    }

    /**
     * @group controller
     * @group publisher
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/publisher/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/publisher/create"]');
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/publisher/%s/edit"]', $this->publisher->getId()));
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/publisher/%s/show"]', $this->publisher->getId()));

        return null;
    }
}
