<?php
/**
 * @package Test\AppBundle\Controller\Content
 */

namespace Test\AppBundle\Controller\Content;

use AppBundle\Entity\Franchise;
use Test\AppBundle\AbstractWebTest;

/**
 * Class FranchiseControllerTest
 */
class FranchiseControllerTest extends AbstractWebTest
{
    /**
     * @var Franchise
     */
    protected $franchise;

    /**
     * @return $this
     */
    public function setUp()
    {
        $this->setClient('admin', 'admin');
        $this->setEntityManager();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Franchise');
        $this->franchise = $repository->findBy(
            array(),
            array(),
            1
        )[0];

        return $this;
    }

    /**
     * @group controller
     * @group franchise
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/franchise/create');

        $this->checkIfOneContentExist($crawler, 'input[id="franchise_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="franchise_description"]');
        $this->checkIfOneContentExist($crawler, 'select[id="franchise_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'select[id="franchise_publisher"]');
        $this->checkIfOneContentExist($crawler, 'select[id="franchise_studio"]');
        $this->checkIfOneContentExist($crawler, 'select[id="franchise_background_image"]');
        $this->checkIfOneContentExist($crawler, 'button[id="franchise_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="franchise_saveAndPublish"]');

        return null;
    }

    /**
     * @group controller
     * @group franchise
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/franchise/%s/edit', $this->franchise->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="franchise_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="franchise_description"]');
        $this->checkIfOneContentExist($crawler, 'select[id="franchise_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'select[id="franchise_publisher"]');
        $this->checkIfOneContentExist($crawler, 'select[id="franchise_studio"]');
        $this->checkIfOneContentExist($crawler, 'select[id="franchise_background_image"]');
        $this->checkIfOneContentExist($crawler, 'button[id="franchise_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="franchise_saveAndPublish"]');

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/franchise/%s/show"]', $this->franchise->getId()));

        return null;
    }

    /**
     * @group controller
     * @group franchise
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/franchise/%s/show', $this->franchise->getId()));

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/franchise/%s/edit"]', $this->franchise->getId()));

        return null;
    }

    /**
     * @group controller
     * @group franchise
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/franchise/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/franchise/create"]');
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/franchise/%s/edit"]', $this->franchise->getId()));
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/franchise/%s/show"]', $this->franchise->getId()));

        return null;
    }
}
