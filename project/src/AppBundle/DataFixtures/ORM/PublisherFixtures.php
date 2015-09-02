<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Publisher;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PublisherFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/publisher.xml'));

        foreach ($xml->item as $item) {
            $publisher = new Publisher();
            $publisher->setName("$item->name");
            $publisher->setDescription("$item->description");
            $publisher->setPublished(intval("$item->published"));
            $publisher->setBackgroundLink("$item->backgroundLink");

            $manager->getRepository('AppBundle:Publisher')->save(
                $publisher
            );

            $this->addReference('publisher-'.$publisher->getSlug(), $publisher);
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
        return 6;
    }
}
