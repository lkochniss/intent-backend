<?php
/**
 * @package AppBundle\DataFixtures\ORM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Studio;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class StudioFixtures
 */
class StudioFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * @param ObjectManager $manager Manager to save studio.
     * @return boolean
     */
    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/studio.xml'));

        foreach ($xml->item as $item) {
            $studio = new Studio();
            $studio->setName("$item->name");
            $studio->setDescription("$item->description");
            $studio->setPublished(intval("$item->published"));
            $studio->setBackgroundLink("$item->backgroundLink");

            if ("$item->backgroundImage" != '') {
                $studio->setBackgroundImage($this->getReference("$item->backgroundImage"));
            }

            if ("$item->thumbnail" != '') {
                $studio->setThumbnail($this->getReference("$item->thumbnail"));
            }

            $manager->getRepository('AppBundle:Studio')->save(
                $studio
            );

            $this->setReference('studio-' . $studio->getSlug(), $studio);
        }

        return true;
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
        return 7;
    }
}
