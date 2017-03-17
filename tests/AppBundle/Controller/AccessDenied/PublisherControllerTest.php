<?php
/**
 * @package Test\AppBundle\Controller\AccessDenied
 */

namespace Test\AppBundle\Controller\AccessDenied;

use AppBundle\Entity\Publisher;
use Test\AppBundle\AbstractWebTest;

/**
 * Class PublisherControllerTest
 */
class PublisherControllerTest extends AbstractWebTest
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
        $this->setClient('0-Permission-User', 'no permission');
        $this->setEntityManager();

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
        $crawler = $this->pageResponse('GET', '/publisher/create', 403);

        return null;
    }

    /**
     * @group controller
     * @group publisher
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/publisher/%s/edit', $this->publisher->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group publisher
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/publisher/%s/show', $this->publisher->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group publisher
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/publisher/', 403);

        return null;
    }
}
