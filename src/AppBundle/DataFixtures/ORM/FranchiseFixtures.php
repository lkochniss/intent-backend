<?php
/**
 * @package AppBundle\DataFixtures\ORM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Franchise;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class FranchiseFixtures
 */
class FranchiseFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * @param ObjectManager $manager Manager to save franchise.
     * @return null
     */
    public function load(ObjectManager $manager)
    {
//        $xml = new SimpleXMLExtended(file_get_contents('web/export/franchise.xml'));
//
//        foreach ($xml->item as $item) {
//            $franchise = new Franchise();
//            $franchise->setName("$item->name");
//            $franchise->setDescription("$item->description");
//            $franchise->setPublished(intval("$item->published"));
//            $franchise->setBackgroundLink("$item->backgroundLink");
//
//            if ("$item->publisher" != '') {
//                $franchise->setPublisher($this->getReference("$item->publisher"));
//            }
//
//            if ("$item->studio" != '') {
//                $franchise->setStudio($this->getReference("$item->studio"));
//            }
//
//            if ("$item->backgroundImage" != '') {
//                $franchise->setBackgroundImage($this->getReference("$item->backgroundImage"));
//            }
//
//            if ("$item->thumbnail" != '') {
//                $franchise->setThumbnail($this->getReference("$item->thumbnail"));
//            }
//
//
//            $manager->getRepository('AppBundle:Franchise')->save(
//                $franchise
//            );
//
//            $this->addReference('franchise-' . $franchise->getSlug(), $franchise);
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
        return 8;
    }
}
