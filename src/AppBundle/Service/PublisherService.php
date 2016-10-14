<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Publisher;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class PublisherService
 */
class PublisherService
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
        $this->repository = $manager->getRepository('AppBundle:Publisher');
    }

    /**
     * @return boolean
     */
    public function exportEntities()
    {
        $publishers = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Publisher $publisher
         */
        foreach ($publishers as $publisher) {
            $item = $xml->addChild('item');

            $item->name = null;
            $item->name->addCData($publisher->getName());

            $item->description = null;
            $item->description->addCData($publisher->getDescription());

            $item->published = null;
            $item->published->addCData($publisher->isPublished());

            $item->backgroundLink = null;
            $item->backgroundLink->addCData($publisher->getBackgroundLink());

            $item->backgroundImage = null;
            if ($publisher->getBackgroundImage()) {
                $item->backgroundImage->addCData($publisher->getBackgroundImage()->getFullPath());
            }

            $item->thumbnail = null;
            if ($publisher->getThumbnail()) {
                $item->thumbnail->addCData($publisher->getThumbnail()->getFullPath());
            }
        }

        $xml->saveXML('web/export/publisher.xml');

        return true;
    }

    /**
     * @param string $path The import path.
     * @return boolean
     */
    public function importEntities($path = 'web/export/publisher.xml')
    {
        $xml = new SimpleXMLExtended(file_get_contents($path));

        foreach ($xml->item as $item) {
            $publisher = new Publisher();
            $publisher->setName("$item->name");
            $publisher->setDescription("$item->description");
            $publisher->setPublished(intval("$item->published"));

            if ("$item->backgroundImage" != '') {
                $publisher->setBackgroundImage(
                    $this->manager->getRepository('AppBundle:Image')->findOneBy(
                        array(
                            'fullPath' => "$item->backgroundImage"
                        )
                    )
                );
            }

            if ("$item->thumbnail" != '') {
                $publisher->setBackgroundImage(
                    $this->manager->getRepository('AppBundle:Image')->findOneBy(
                        array(
                            'fullPath' => "$item->thumbnail"
                        )
                    )
                );
            }

            $this->repository->save($publisher);
        }

        return true;
    }
}
