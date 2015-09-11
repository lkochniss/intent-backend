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
        $this->pageResponse('GET', '/publisher/create');

        return null;
    }

    /**
     * @return null
     */
    public function testEditPage()
    {
        $this->pageResponse('GET', sprintf('/publisher/%s/edit', $this->publisher->getId()));

        return null;
    }

    /**
     * @return null
     */
    public function testShowPage()
    {
        $this->pageResponse('GET', sprintf('/publisher/%s/edit', $this->publisher->getId()));

        return null;
    }

    /**
     * @return null
     */
    public function testListPage()
    {
        $this->pageResponse('GET', '/publisher/');

        return null;
    }
}
