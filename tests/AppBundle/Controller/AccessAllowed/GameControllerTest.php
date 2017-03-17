<?php
/**
 * @package Test\AppBundle\Controller\AccessAllowed
 */

namespace Test\AppBundle\Controller\AccessAllowed;

use AppBundle\Entity\Game;
use Test\AppBundle\AbstractWebTest;

/**
 * Class GameControllerTest
 */
class GameControllerTest extends AbstractWebTest
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
        $this->setClient('Publishing Editor', 'publishing');
        $this->setEntityManager();

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

        return null;
    }
}
