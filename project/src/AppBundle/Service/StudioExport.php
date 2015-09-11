<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Studio;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class StudioExport
 */
class StudioExport
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

            $item->backgroundImage = null;
            if ($studio->getBackgroundImage()) {
                $item->backgroundImage->addCData('image-' . $studio->getBackgroundImage()->getFullPath());
            }

            $item->thumbnail = null;
            if ($studio->getThumbnail()) {
                $item->thumbnail->addCData('image-' . $studio->getThumbnail()->getFullPath());
            }
        }

        $xml->saveXML('web/export/studio.xml');

        return true;
    }
}
