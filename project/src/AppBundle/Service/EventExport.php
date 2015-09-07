<?php

namespace AppBundle\Service;

use AppBundle\Entity\Event;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class EventExport
 * @package AppBundle\Service
 */
class EventExport
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
        $events = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Event $event
         */
        foreach ($events as $event) {
            $item = $xml->addChild('item');

            $item->name = null;
            $item->name->addCData($event->getName());

            $item->description = null;
            $item->description->addCData($event->getDescription());

            $item->published = null;
            $item->published->addCData($event->isPublished());

            $item->startAt = null;
            $item->startAt->addCData($event->getStartAt()->format('Y-m-d'));

            $item->endAt = null;
            $item->endAt->addCData($event->getEndAt()->format('Y-m-d'));

            $item->backgroundImage = null;
            if ($event->getBackgroundImage()) {
                $item->backgroundImage->addCData('image-'. $event->getBackgroundImage()->getFullPath());
            }

            $item->thumbnail = null;
            if ($event->getThumbnail()) {
                $item->thumbnail->addCData('image-'. $event->getThumbnail()->getFullPath());
            }
        }

        $xml->saveXML('web/export/event.xml');
    }
}
