<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Franchise;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class FranchiseService
 */
class FranchiseService
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
        $this->repository = $manager->getRepository('AppBundle:Franchise');
    }

    /**
     * @param string $path The export path.
     * @return boolean
     */
    public function exportEntities($path = 'web/export/franchise.xml')
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
                $item->publisher->addCData($franchise->getPublisher()->getSlug());
            }

            $item->studio = null;
            if ($franchise->getStudio()) {
                $item->studio->addCData($franchise->getStudio()->getSlug());
            }

            $item->backgroundImage = null;
            if ($franchise->getBackgroundImage()) {
                $item->backgroundImage->addCData($franchise->getBackgroundImage()->getFullPath());
            }

            $item->thumbnail = null;
            if ($franchise->getThumbnail()) {
                $item->thumbnail->addCData($franchise->getThumbnail()->getFullPath());
            }
        }

        $xml->saveXML($path);

        return true;
    }

    /**
     * @param string $path The import path.
     * @return boolean
     */
    public function importEntities($path = 'web/export/franchise.xml')
    {
        $xml = new SimpleXMLExtended(file_get_contents($path));

        foreach ($xml->item as $item) {
            $franchise = new Franchise();
            $franchise->setName("$item->name");
            $franchise->setDescription("$item->description");
            $franchise->setPublished(intval("$item->published"));
            $franchise->setBackgroundLink("$item->backgroundLink");

            if ("$item->publisher" != '') {
                $franchise->setPublisher(
                    $this->manager->getRepository('AppBundle:Publisher')->findOneBy(
                        array(
                            'slug' => "$item->publisher"
                        )
                    )
                );
            }

            if ("$item->studio" != '') {
                $franchise->setStudio(
                    $this->manager->getRepository('AppBundle:Studio')->findOneBy(
                        array(
                            'slug' => "$item->studio"
                        )
                    )
                );
            }

            if ("$item->backgroundImage" != '') {
                $franchise->setBackgroundImage(
                    $this->manager->getRepository('AppBundle:Image')->findOneBy(
                        array(
                            'fullPath' => "$item->backgroundImage"
                        )
                    )
                );
            }

            if ("$item->thumbnail" != '') {
                $franchise->setBackgroundImage(
                    $this->manager->getRepository('AppBundle:Image')->findOneBy(
                        array(
                            'fullPath' => "$item->thumbnail"
                        )
                    )
                );
            }

            $this->repository->save($franchise);
        }

        return true;
    }
}
