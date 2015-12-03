<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Image;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class ImageExport
 */
class ImageExport
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

            $item->fullpath = null;
            $item->fullpath->addCData($image->getFullPath());

            $item->parent = null;
            if ($image->getParentDirectory()) {
                $item->parent->addCData($image->getParentDirectory()->getName());
            }

            $filesystem = new Filesystem();
            $filesystem->copy('web/' . $image->getFullPath(), 'web/export/images/' . $image->getFullPath());
        }

        $xml->saveXML('web/export/image.xml');

        return true;
    }
}
