<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Game;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class GameExport
 */
class GameExport
{
    /** @var  EntityRepository */
    private $repository;

    /**
     * @param EntityRepository $repository Get the entity repository.
     */
    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return boolean
     */
    public function exportEntity()
    {
        $games = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Game $game
         */
        foreach ($games as $game) {
            $item = $xml->addChild('item');

            $item->name = null;
            $item->name->addCData($game->getName());

            $item->description = null;
            $item->description->addCData($game->getDescription());

            $item->published = null;
            $item->published->addCData($game->isPublished());

            $item->backgroundLink = null;
            $item->backgroundLink->addCData($game->getBackgroundLink());

            $item->franchise = null;
            if ($game->getFranchise()) {
                $item->franchise->addCData('franchise-' . $game->getFranchise()->getSlug());
            }

            $item->studio = null;
            if ($game->getStudio()) {
                $item->studio->addCData('studio-' . $game->getStudio()->getSlug());
            }

            $item->backgroundImage = null;
            if ($game->getBackgroundImage()) {
                $item->backgroundImage->addCData('image-' . $game->getBackgroundImage()->getFullPath());
            }

            $item->thumbnail = null;
            if ($game->getThumbnail()) {
                $item->thumbnail->addCData('image-' . $game->getThumbnail()->getFullPath());
            }
        }

        $xml->saveXML('web/export/game.xml');

        return true;
    }
}
