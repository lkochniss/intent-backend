<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use AppBundle\Form\Type\GamePublishType;
use AppBundle\Form\Type\GameType;

class GameController extends AbstractRelatedController
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
     * @return GamePublishType
     */
    protected function getPublishType()
    {
        return new GamePublishType();
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
        return 'game';
    }

    protected function getReadAccessLevel()
    {
        return 'ROLE_READ_META';
    }

    protected function getWriteAccessLevel()
    {
        return 'ROLE_WRITE_META';
    }

    protected function getPublishAccessLevel()
    {
        return 'ROLE_PUBLISH_META';
    }
}
