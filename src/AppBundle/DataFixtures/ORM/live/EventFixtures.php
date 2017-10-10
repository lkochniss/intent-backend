<?php
/**
 * @package AppBundle\DataFixtures\ORM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Event;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class EventFixtures
 */
class EventFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * @param ObjectManager $manager Manager to save event.
     * @return null
     */
    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/event.xml'));

        foreach ($xml->item as $item) {
            $event = new Event();
            $event->setName("$item->name");
            $event->setPublished(intval("$item->published"));
            $event->setDescription("$item->description");
            $event->setStartAt(new \DateTime("$item->startAt"));
            $event->setEndAt(new \DateTime("$item->endAt"));

            if ("$item->backgroundImage" != '') {
                $event->setBackgroundImage($this->getReference("$item->backgroundImage"));
            }

            if ("$item->thumbnail" != '') {
                $event->setThumbnail($this->getReference("$item->thumbnail"));
            }

            $manager->getRepository('AppBundle:Event')->save(
                $event
            );
            $this->setReference('event-' . $event->getSlug(), $event);
        }

        return null;
    }

    /**
     * @param ContainerInterface|null $containerInterface ContainerInterface.
     * @return EventFixtures
     */
    public function setContainer(ContainerInterface $containerInterface = null) : EventFixtures
    {
        $this->container = $containerInterface;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOrder() : int
    {
        return 11;
    }
}
