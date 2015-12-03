<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Expansion;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class ExpansionExport
 */
class ExpansionExport
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
                $item->game->addCData('game-' . $expansion->getGame()->getSlug());
            }

            $item->backgroundImage = null;
            if ($expansion->getBackgroundImage()) {
                $item->backgroundImage->addCData('image-' . $expansion->getBackgroundImage()->getFullPath());
            }

            $item->thumbnail = null;
            if ($expansion->getThumbnail()) {
                $item->thumbnail->addCData('image-' . $expansion->getThumbnail()->getFullPath());
            }
        }

        $xml->saveXML('web/export/expansion.xml');

        return true;
    }
}
