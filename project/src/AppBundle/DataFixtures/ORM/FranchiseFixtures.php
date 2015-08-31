<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Franchise;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FranchiseFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/franchise.xml'));

        foreach ($xml->item as $item) {
            $franchise = new Franchise();
            $franchise->setName("$item->name");
            $franchise->setDescription("$item->description");
            $franchise->setPublished(intval("$item->published"));
            $franchise->setBackgroundLink("$item->backgroundLink");

            if("$item->publisher" != ""){
                $franchise->setPublisher($this->getReference("$item->publisher"));
            }

            if("$item->studio" != ""){
                $franchise->setStudio($this->getReference("$item->studio"));
            }

            $manager->getRepository('AppBundle:Franchise')->save(
                $franchise
            );

            $this->addReference('franchise-'.$franchise->getSlug(), $franchise);
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
