<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Studio;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class StudioFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/studio.xml'));

        foreach ($xml->item as $item) {
            $studio = new Studio();
            $studio->setName("$item->name");
            $studio->setDescription("$item->description");
            $studio->setPublished(intval("$item->published"));
            $studio->setBackgroundLink("$item->backgroundLink");

            $manager->getRepository('AppBundle:Studio')->save(
                $studio
            );

            $this->addReference('studio-'.$studio->getSlug(), $studio);
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
        return 7;
    }
}
