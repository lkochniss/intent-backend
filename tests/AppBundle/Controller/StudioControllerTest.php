<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller;

use AppBundle\Entity\Studio;

/**
 * Class StudioControllerTest
 */
class StudioControllerTest extends AbstractControllerTest
{
    /**
     * @var Studio
     */
    protected $studio;

    /**
     * @return $this
     */
    public function setUp()
    {
        parent::setUp();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Studio');
        $this->studio = $repository->findBy(
            array(),
            array(),
            1
        )[0];

        return $this;
    }

    /**
     * @group controller
     * @group studio
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/studio/create');

        $this->checkIfOneContentExist($crawler, 'input[id="studio_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="studio_description"]');
        $this->checkIfOneContentExist($crawler, 'select[id="studio_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'select[id="studio_background_image"]');
        $this->checkIfOneContentExist($crawler, 'button[id="studio_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="studio_saveAndPublish"]');

        return null;
    }

    /**
     * @group controller
     * @group studio
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/studio/%s/edit', $this->studio->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="studio_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="studio_description"]');
        $this->checkIfOneContentExist($crawler, 'select[id="studio_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'select[id="studio_background_image"]');
        $this->checkIfOneContentExist($crawler, 'button[id="studio_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="studio_saveAndPublish"]');

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/studio/%s/show"]', $this->studio->getId()));

        return null;
    }

    /**
     * @group controller
     * @group studio
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/studio/%s/show', $this->studio->getId()));

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/studio/%s/edit"]', $this->studio->getId()));

        return null;
    }

    /**
     * @group controller
     * @group studio
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/studio/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/studio/create"]');
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/studio/%s/edit"]', $this->studio->getId()));
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/studio/%s/show"]', $this->studio->getId()));

        return null;
    }
}
