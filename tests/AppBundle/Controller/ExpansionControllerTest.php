<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller;

use AppBundle\Entity\Expansion;

/**
 * Class ExpansionControllerTest
 */
class ExpansionControllerTest extends AbstractControllerTest
{
    /**
     * @var Expansion
     */
    protected $expansion;

    /**
     * @group controller
     * @return $this
     */
    public function setUp()
    {
        parent::setUp();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Expansion');
        $this->expansion = $repository->findBy(
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
        $crawler = $this->pageResponse('GET', '/expansion/create');

        $this->checkIfOneContentExist($crawler, 'input[id="expansion_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="expansion_description"]');
        $this->checkIfOneContentExist($crawler, 'select[id="expansion_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'select[id="expansion_game"]');
        $this->checkIfOneContentExist($crawler, 'select[id="expansion_background_image"]');
        $this->checkIfOneContentExist($crawler, 'button[id="expansion_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="expansion_saveAndPublish"]');

        return null;
    }

    /**
     * @group controller
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/expansion/%s/edit', $this->expansion->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="expansion_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="expansion_description"]');
        $this->checkIfOneContentExist($crawler, 'select[id="expansion_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'select[id="expansion_game"]');
        $this->checkIfOneContentExist($crawler, 'select[id="expansion_background_image"]');
        $this->checkIfOneContentExist($crawler, 'button[id="expansion_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="expansion_saveAndPublish"]');

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/expansion/%s/show"]', $this->expansion->getId()));

        return null;
    }

    /**
     * @group controller
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/expansion/%s/show', $this->expansion->getId()));

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/expansion/%s/edit"]', $this->expansion->getId()));

        return null;
    }

    /**
     * @group controller
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/expansion/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/expansion/create"]');
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/expansion/%s/edit"]', $this->expansion->getId()));
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/expansion/%s/show"]', $this->expansion->getId()));

        return null;
    }
}
