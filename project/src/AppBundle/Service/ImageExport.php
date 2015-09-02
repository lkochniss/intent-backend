<?php

namespace AppBundle\Service;

use AppBundle\Entity\Image;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class ImageExport
 * @package AppBundle\Service
 */
class ImageExport
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
        $images = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Image $image
         */
        foreach ($images as $image) {
            $item = $xml->addChild('item');

            $item->name = null;
            $item->name->addCData($image->getName());

            $item->description = null;
            $item->description->addCData($image->getDescription());

            $item->path = null;
            $item->path->addCData($image->getPath());

            $item->parent = null;
            if ($image->getParentDirectory()) {
                $item->parent->addCData($image->getParentDirectory()->getName());
            }
        }

        $xml->saveXML('web/export/image.xml');
    }
}
