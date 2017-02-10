<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller;

use AppBundle\Entity\Game;

/**
 * Class GameControllerTest
 */
class GameControllerTest extends AbstractControllerTest
{
    /**
     * @var Game
     */
    protected $game;

    /**
     * @return $this
     */
    public function setUp()
    {
        parent::setUp();

        $repository = $this->getEntityManager()->getRepository('AppBundle:Game');
        $this->game = $repository->findBy(
            array(),
            array(),
            1
        )[0];

        return $this;
    }

    /**
     * @group controller
     * @group game
     * @return null
     */
    public function testCreatePage()
    {
        $crawler = $this->pageResponse('GET', '/game/create');

        $this->checkIfOneContentExist($crawler, 'input[id="game_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="game_description"]');
        $this->checkIfOneContentExist($crawler, 'select[id="game_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'select[id="game_studio"]');
        $this->checkIfOneContentExist($crawler, 'select[id="game_franchise"]');
        $this->checkIfOneContentExist($crawler, 'select[id="game_background_image"]');
        $this->checkIfOneContentExist($crawler, 'button[id="game_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="game_saveAndPublish"]');

        return null;
    }

    /**
     * @group controller
     * @group game
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/game/%s/edit', $this->game->getId()));

        $this->checkIfOneContentExist($crawler, 'input[id="game_name"]');
        $this->checkIfOneContentExist($crawler, 'textarea[id="game_description"]');
        $this->checkIfOneContentExist($crawler, 'select[id="game_thumbnail"]');
        $this->checkIfOneContentExist($crawler, 'select[id="game_studio"]');
        $this->checkIfOneContentExist($crawler, 'select[id="game_franchise"]');
        $this->checkIfOneContentExist($crawler, 'select[id="game_background_image"]');
        $this->checkIfOneContentExist($crawler, 'button[id="game_save"]');
        $this->checkIfOneContentExist($crawler, 'button[id="game_saveAndPublish"]');

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/game/%s/show"]', $this->game->getId()));

        return null;
    }

    /**
     * @group controller
     * @group game
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/game/%s/show', $this->game->getId()));

        $this->checkIfOneContentExist($crawler, sprintf('a[href="/game/%s/edit"]', $this->game->getId()));

        return null;
    }

    /**
     * @group controller
     * @group game
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/game/');

        $this->checkIfOneContentExist($crawler, 'table[id="entity_list"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/game/create"]');
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/game/%s/edit"]', $this->game->getId()));
        $this->checkIfOneContentExist($crawler, sprintf('a[href="/game/%s/show"]', $this->game->getId()));

        return null;
    }
}
