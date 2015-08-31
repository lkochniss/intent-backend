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

            $item->startedAt = null;
            $item->startedAt->addCData($event->getStartAt()->format('Y-M-d H:i:s'));

            $item->endAt = null;
            $item->endAt->addCData($event->getEndAt()->format('Y-M-d H:i:s'));
        }

        $xml->saveXML('web/export/event.xml');
    }
}
