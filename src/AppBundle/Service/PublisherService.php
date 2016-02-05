<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Publisher;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class PublisherService
 */
class PublisherService
{
    /** @var  EntityRepository */
    private $repository;

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
                $item->backgroundImage->addCData('image-' . $publisher->getBackgroundImage()->getFullPath());
            }

            $item->thumbnail = null;
            if ($publisher->getThumbnail()) {
                $item->thumbnail->addCData('image-' . $publisher->getThumbnail()->getFullPath());
            }
        }

        $xml->saveXML('web/export/publisher.xml');

        return true;
    }
}
