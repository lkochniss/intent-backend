<?php
/**
 * @package AppBundle\DataFixtures\ORM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Tag;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class TagFixtures
 */
class TagFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * @param ObjectManager $manager Manager to save category.
     * @return null
     */
    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/tag.xml'));

        foreach ($xml->item as $item) {
            $tag = new Tag();
            $tag->setName("$item->name");
            $tag->setPublished(intval("$item->published"));

            $manager->getRepository('AppBundle:Tag')->save(
                $tag
            );
            $this->setReference('tag-' . $tag->getSlug(), $tag);
        }

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
        return 13;
    }
}
