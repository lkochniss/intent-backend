<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Franchise;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class FranchiseExport
 */
class FranchiseExport
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
        $franchises = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Franchise $franchise
         */
        foreach ($franchises as $franchise) {
            $item = $xml->addChild('item');

            $item->name = null;
            $item->name->addCData($franchise->getName());

            $item->description = null;
            $item->description->addCData($franchise->getDescription());

            $item->published = null;
            $item->published->addCData($franchise->isPublished());

            $item->backgroundLink = null;
            $item->backgroundLink->addCData($franchise->getBackgroundLink());

            $item->publisher = null;
            if ($franchise->getPublisher()) {
                $item->publisher->addCData('publisher-' . $franchise->getPublisher()->getSlug());
            }

            $item->studio = null;
            if ($franchise->getStudio()) {
                $item->studio->addCData('studio-' . $franchise->getStudio()->getSlug());
            }

            $item->backgroundImage = null;
            if ($franchise->getBackgroundImage()) {
                $item->backgroundImage->addCData('image-' . $franchise->getBackgroundImage()->getFullPath());
            }

            $item->thumbnail = null;
            if ($franchise->getThumbnail()) {
                $item->thumbnail->addCData('image-' . $franchise->getThumbnail()->getFullPath());
            }
        }

        $xml->saveXML('web/export/franchise.xml');

        return true;
    }
}
