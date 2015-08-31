<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Event;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EventFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

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

            $manager->getRepository('AppBundle:Event')->save(
                $event
            );
            $this->addReference('event-'.$event->getSlug(), $event);
        }
    }

    /**
     * @param ContainerInterface|null $containerInterface
     */
    public function setContainer(ContainerInterface $containerInterface = null)
    {
        $this->container = $containerInterface;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 10;
    }
}
