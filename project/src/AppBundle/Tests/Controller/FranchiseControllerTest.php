<?php
/**
 * @package AppBundle\Tests\Controller
 */

namespace AppBundle\Tests\Controller;

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
        $this->checkIfOneContentExist($crawler, 'button[id="franchise_submit"]');

        return null;
    }

    /**
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
        $this->checkIfOneContentExist($crawler, 'button[id="franchise_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/franchise/%s/show', $this->franchise->getId()));

        $this->checkIfOneContentExist($crawler, 'button[id="franchise_publish_submit"]');

        return null;
    }

    /**
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/franchise/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');

        return null;
    }
}
