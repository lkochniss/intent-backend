<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Event;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class EventService
 */
class EventService
{
    /**
     * @var \AppBundle\Repository\EventRepository
     */
    private $repository;

    /**
     * @param EntityManager $manager Get the entityManager.
     */
    public function __construct(EntityManager $manager)
    {
        $this->repository = $manager->getRepository('AppBundle:Event');
    }

    /**
     * @param string $path The export path.
     * @return boolean
     */
    public function exportEntities($path = 'web/export/event.xml')
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

            $item->backgroundLink = null;
            $item->backgroundLink->addCData($event->getBackgroundLink());

            $item->backgroundImage = null;
            if ($event->getBackgroundImage()) {
                $item->backgroundImage->addCData($event->getBackgroundImage()->getFullPath());
            }

            $item->thumbnail = null;
            if ($event->getThumbnail()) {
                $item->thumbnail->addCData($event->getThumbnail()->getFullPath());
            }
        }

        $xml->saveXML($path);

        return true;
    }

    /**
     * @param string $path The import path.
     * @return boolean
     */
    public function importEntities($path = 'web/export/event.xml')
    {
        $xml = new SimpleXMLExtended(file_get_contents($path));

        foreach ($xml->item as $item) {
            $event = new Event();
            $event->setName("$item->name");
            $event->setPublished(intval("$item->published"));
            $event->setDescription("$item->description");
            $event->setStartAt(new \DateTime("$item->startAt"));
            $event->setEndAt(new \DateTime("$item->endAt"));

            if ("$item->backgroundImage" != '') {
                $event->setBackgroundImage(
                    $this->manager->getRepository('AppBundle:Image')->findOneBy(
                        array(
                            'fullPath' => "$item->backgroundImage"
                        )
                    )
                );
            }

            if ("$item->thumbnail" != '') {
                $event->setBackgroundImage(
                    $this->manager->getRepository('AppBundle:Image')->findOneBy(
                        array(
                            'fullPath' => "$item->thumbnail"
                        )
                    )
                );
            }

            $this->repository->save($event);
        }

        return true;
    }
}
