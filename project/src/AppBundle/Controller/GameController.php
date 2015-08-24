<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use AppBundle\Form\Type\GameType;

class GameController extends RelatedController
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
}
