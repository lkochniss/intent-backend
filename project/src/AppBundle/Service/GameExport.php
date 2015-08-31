<?php

namespace AppBundle\Service;

use AppBundle\Entity\Game;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class GameExport
 * @package AppBundle\Service
 */
class GameExport
{
    /** @var  EntityRepository */
    private $repository;

    /**
     * @param EntityRepository $repository
     */
    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

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
                $item->franchise->addCData('franchise-'.$game->getFranchise()->getSlug());
            }

            $item->studio = null;
            if ($game->getStudio()) {
                $item->studio->addCData('studio-'.$game->getStudio()->getSlug());
            }
        }

        $xml->saveXML('web/export/game.xml');
    }
}
