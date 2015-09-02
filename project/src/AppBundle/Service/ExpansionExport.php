<?php

namespace AppBundle\Service;

use AppBundle\Entity\Expansion;
use AppBundle\Entity\Game;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class ExpansionExport
 * @package AppBundle\Service
 */
class ExpansionExport
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
        $expansions = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Expansion $expansion
         */
        foreach ($expansions as $expansion) {
            $item = $xml->addChild('item');

            $item->name = null;
            $item->name->addCData($expansion->getName());

            $item->description = null;
            $item->description->addCData($expansion->getDescription());

            $item->published = null;
            $item->published->addCData($expansion->isPublished());

            $item->backgroundLink = null;
            $item->backgroundLink->addCData($expansion->getBackgroundLink());

            $item->game = null;
            if ($expansion->getGame()) {
                $item->game->addCData('game-'.$expansion->getGame()->getSlug());
            }
        }

        $xml->saveXML('web/export/expansion.xml');
    }
}
