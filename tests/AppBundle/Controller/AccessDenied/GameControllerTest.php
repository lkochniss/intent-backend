<?php
/**
 * @package Test\AppBundle\Controller\AccessDenied
 */

namespace Test\AppBundle\Controller\AccessDenied;

use AppBundle\Entity\Game;
use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class GameControllerAccessDeniedTest
 */
class GameControllerAccessDeniedTest extends AbstractControllerTest
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
        $this->setClient('0-Permission-User', 'no permission');
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
        $crawler = $this->pageResponse('GET', '/game/create', 403);

        return null;
    }

    /**
     * @group controller
     * @group game
     * @return null
     */
    public function testEditPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/game/%s/edit', $this->game->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group game
     * @return null
     */
    public function testShowPage()
    {
        $crawler = $this->pageResponse('GET', sprintf('/game/%s/show', $this->game->getId()), 403);

        return null;
    }

    /**
     * @group controller
     * @group game
     * @return null
     */
    public function testListPage()
    {
        $crawler = $this->pageResponse('GET', '/game/', 403);

        return null;
    }
}
