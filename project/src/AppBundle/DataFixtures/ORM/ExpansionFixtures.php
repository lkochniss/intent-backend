<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Expansion;
use AppBundle\Entity\Game;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ExpansionFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/expansion.xml'));

        foreach ($xml->item as $item) {
            $expansion = new Expansion();
            $expansion->setName("$item->name");
            $expansion->setDescription("$item->description");
            $expansion->setPublished(intval("$item->published"));
            $expansion->setBackgroundLink("$item->backgroundLink");

            if ("$item->game" != "") {
                $expansion->setGame($this->getReference("$item->game"));
            }

            $manager->getRepository('AppBundle:Expansion')->save(
                $expansion
            );

            $this->addReference('dlc/expansion-'.$expansion->getSlug(), $expansion);
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
