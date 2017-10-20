<?php
/**
 * @package AppBundle\DataFixtures\ORM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Expansion;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ExpansionFixtures
 */
class ExpansionFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/expansion.xml'));

        foreach ($xml->item as $item) {
            $expansion = new Expansion();
            $expansion->setName("$item->name");
            $expansion->setDescription("$item->description");
            $expansion->setPublished(intval("$item->published"));
            $expansion->setBackgroundLink("$item->backgroundLink");

            if ("$item->game" != '') {
                $expansion->setGame($this->getReference("$item->game"));
            }

            if ("$item->backgroundImage" != '') {
                $expansion->setBackgroundImage($this->getReference("$item->backgroundImage"));
            }

            if ("$item->thumbnail" != '') {
                $expansion->setThumbnail($this->getReference("$item->thumbnail"));
            }


            $manager->getRepository('AppBundle:Expansion')->save(
                $expansion
            );

            $this->addReference('dlc/expansion-' . $expansion->getSlug(), $expansion);
        }
    }

    /**
     * @param ContainerInterface|null $containerInterface ContainerInterface.
     * @return ExpansionFixtures
     */
    public function setContainer(ContainerInterface $containerInterface = null) : ExpansionFixtures
    {
        $this->container = $containerInterface;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOrder() : int
    {
        return 10;
    }
}
