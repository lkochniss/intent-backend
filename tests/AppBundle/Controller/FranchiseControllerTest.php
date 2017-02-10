<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller;

use AppBundle\Entity\Franchise;

/**
 * Class FranchiseControllerTest
 */
class FranchiseControllerTest extends AbstractControllerTest
{
    /**
     * @var Franchise
     */
    protected $franchise;

    /**
     * @group controller
     * @return $this
     */
    public function setUp()
    {
        parent::setUp();

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
