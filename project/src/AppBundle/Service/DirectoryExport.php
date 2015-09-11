<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Directory;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class DirectoryExport
 */
class DirectoryExport
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
        $directories = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Directory $directory
         */
        foreach ($directories as $directory) {
            $item = $xml->addChild('item');

            $item->name = null;
            $item->name->addCData($directory->getName());

            $item->path = null;
            $item->path->addCData($directory->getPath());

            $item->parent = null;
            if ($directory->getParentDirectory()) {
                $item->parent->addCData($directory->getParentDirectory()->getName());
            }
        }

        $xml->saveXML('web/export/directory.xml');

        return true;
    }
}
