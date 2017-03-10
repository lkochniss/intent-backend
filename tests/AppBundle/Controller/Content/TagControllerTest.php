<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller\Content;

use AppBundle\Entity\Tag;
use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class TagControllerTest
 */
class TagControllerTest extends AbstractControllerTest
{
    /**
     * @var Tag
     */
    protected $tag;

    /**
     * @return $this
     */
    public function setUp()
    {
        parent::setUp();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Tag');
        $this->tag = $repository->findBy(
            array(),
            array(),
            1
        )[0];

        return $this;
    }

    /**
     * @group controller
     * @group tag
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/tag/create');

        $this->checkIfOneContentExist($crawler, 'input[id="tag_name"]');
        $this->checkIfOneContentExist($crawler, 'button[id="tag_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="tag_saveAndPublish"]');

        return null;
    }

    /**
     * @group controller
     * @group tag
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/tag/%s/edit', $this->tag->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="tag_name"]');
        $this->checkIfOneContentExist($crawler, 'button[id="tag_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="tag_saveAndPublish"]');

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/tag/%s/show"]', $this->tag->getId()));

        return null;
    }

    /**
     * @group controller
     * @group tag
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/tag/%s/show', $this->tag->getId()));

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/tag/%s/edit"]', $this->tag->getId()));

        return null;
    }

    /**
     * @group controller
     * @group tag
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/tag/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/tag/create"]');
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/tag/%s/edit"]', $this->tag->getId()));
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/tag/%s/show"]', $this->tag->getId()));

        return null;
    }

    /**
     * @return string
     */
    protected function getUsername()
    {
        return 'admin';
    }

    /**
     * @return string
     */
    protected function getPassword()
    {
        return 'admin';
    }
}
