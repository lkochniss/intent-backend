<?php
/**
 * @package AppBundle\DataFixtures\ORM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Publisher;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class PublisherFixtures
 */
class PublisherFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * @param ObjectManager $manager Manager to save publisher.
     * @return null
     */
    public function load(ObjectManager $manager)
    {
//        $xml = new SimpleXMLExtended(file_get_contents('web/export/publisher.xml'));
//
//        foreach ($xml->item as $item) {
//            $publisher = new Publisher();
//            $publisher->setName("$item->name");
//            $publisher->setDescription("$item->description");
//            $publisher->setPublished(intval("$item->published"));
//            $publisher->setBackgroundLink("$item->backgroundLink");
//
//            if ("$item->backgroundImage" != '') {
//                $publisher->setBackgroundImage($this->getReference("$item->backgroundImage"));
//            }
//
//            if ("$item->thumbnail" != '') {
//                $publisher->setThumbnail($this->getReference("$item->thumbnail"));
//            }
//
//            $manager->getRepository('AppBundle:Publisher')->save(
//                $publisher
//            );
//
//            $this->addReference('publisher-' . $publisher->getSlug(), $publisher);
//        }

        return null;
    }

    /**
     * @param ContainerInterface|null $containerInterface ContainerInterface.
     * @return $this
     */
    public function setContainer(ContainerInterface $containerInterface = null)
    {
        $this->container = $containerInterface;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOrder()
    {
        return 6;
    }
}
