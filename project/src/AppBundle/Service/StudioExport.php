<?php

namespace AppBundle\Service;

use AppBundle\Entity\Studio;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class StudioExport
 * @package AppBundle\Service
 */
class StudioExport
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
        $studios = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');


        /**
         * @var Studio $studio
         */
        foreach ($studios as $studio) {
            $item = $xml->addChild('item');

            $item->name = null;
            $item->name->addCData($studio->getName());

            $item->description = null;
            $item->description->addCData($studio->getDescription());

            $item->published = null;
            $item->published->addCData($studio->isPublished());

            $item->backgroundLink = null;
            $item->backgroundLink->addCData($studio->getBackgroundLink());
        }

        $xml->saveXML('web/export/studio.xml');
    }
}
