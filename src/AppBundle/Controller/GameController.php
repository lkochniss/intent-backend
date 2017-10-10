<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractModel;
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
    protected function createNewEntity() : AbstractModel
    {
        return new Game();
    }

    /**
     * @return string
     */
    protected function getFormType()  : string
    {
        return GameType::class;
    }

    /**
     * @return string
     */
    protected function getTemplateBasePath() : string
    {
        return 'Game';
    }

    /**
     * @return string
     */
    protected function getEntityName() : string
    {
        return 'AppBundle\Entity\Game';
    }

    /**
     * @return string
     */
    protected function getRoutePrefix() : string
    {
        return 'intent_backend_game';
    }

    /**
     * @return string
     */
    protected function getTranslationDomain() : string
    {
        return 'game';
    }

    /**
     * @return string
     */
    protected function getReadAccessLevel() : string
    {
        return 'ROLE_READ_META';
    }

    /**
     * @return string
     */
    protected function getWriteAccessLevel() : string
    {
        return 'ROLE_WRITE_META';
    }

    /**
     * @return string
     */
    protected function getPublishAccessLevel() : string
    {
        return 'ROLE_PUBLISH_META';
    }
}
