<?php
/**
 * @package AppBundle\Tests\Controller
 */

namespace AppBundle\Tests\Controller;

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
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/publisher/create');

        $this->checkIfOneContentExist($crawler, 'input[id="publisher_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="publisher_description"]');
        $this->checkIfOneContentExist($crawler, 'select[id="publisher_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'select[id="publisher_background_image"]');
        $this->checkIfOneContentExist($crawler, 'button[id="publisher_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/publisher/%s/edit', $this->publisher->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="publisher_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="publisher_description"]');
        $this->checkIfOneContentExist($crawler, 'select[id="publisher_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'select[id="publisher_background_image"]');
        $this->checkIfOneContentExist($crawler, 'button[id="publisher_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/publisher/%s/show', $this->publisher->getId()));

        $this->checkIfOneContentExist($crawler, 'button[id="publisher_publish_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/publisher/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');

        return null;
    }
}
