<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use AppBundle\Form\Type\GameType;

class GameController extends AbstractCrudController
{
    /**
     * @return Game
     */
    protected function createNewEntity()
    {
        return new Game();
    }

    /**
     * @return GameType
     */
    protected function getFormType()
    {
        return new GameType();
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath()
    {
        return 'Game';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'AppBundle\Entity\Game';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix()
    {
        return 'intent_backend_game';
    }

    protected function getTranslationDomain()
    {
        return 'article';
    }

    public function showAction($id)
    {
        return $this->render(
            ':Game:show.html.twig',
            array(// ...
            )
        );
    }

    public function deleteAction($id)
    {
        return $this->render(
            ':Game:delete.html.twig',
            array(// ...
            )
        );
    }

}
