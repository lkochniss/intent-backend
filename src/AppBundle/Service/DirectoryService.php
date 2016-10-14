<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Directory;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class DirectoryService
 */
class DirectoryService
{
    /** @var  EntityManager */
    private $manager;

    /** @var  EntityRepository */
    private $repository;

    /**
     * @param EntityManager $manager Get the entityManager.
     */
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
        $this->repository = $manager->getRepository('AppBundle:Directory');
    }

    /**
     * @param string $path The export path.
     * @return boolean
     */
    public function exportEntities($path = 'web/export/directory.xml')
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
                $item->parent->addCData($directory->getParentDirectory()->getFullPath());
            }
        }

        $xml->saveXML($path);

        return true;
    }

    /**
     * @param string $path The import path.
     * @return boolean
     */
    public function importEntities($path = 'web/export/directory.xml')
    {
        $xml = new SimpleXMLExtended(file_get_contents($path));

        foreach ($xml->item as $item) {
            $directory = new Directory();
            $directory->setName("$item->name");
            $directory->setPath("$item->path");

            if ("$item->parent" != '') {
                $directory->setParentDirectory(
                    $this->manager->getRepository('AppBundle:Directory')->findOneBy(
                        array(
                        'fullPath' => "$item->parent"
                        )
                    )
                );
            }

            $this->repository->save($directory);
        }

        return true;
    }
}
