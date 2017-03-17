<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use AppBundle\Form\Type\GameType;

/**
 * Class GameController
 */
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
        return GameType::class;
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

    /**
     * @return string
     */
    protected function getTranslationDomain()
    {
        return 'game';
    }

    /**
     * @return string
     */
    protected function getReadAccessLevel()
    {
        return 'ROLE_READ_META';
    }

    /**
     * @return string
     */
    protected function getWriteAccessLevel()
    {
        return 'ROLE_WRITE_META';
    }

    /**
     * @return string
     */
    protected function getPublishAccessLevel()
    {
        return 'ROLE_PUBLISH_META';
    }
}
