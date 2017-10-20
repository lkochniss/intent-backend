<?php
/**
 * @package AppBundle\DataFixtures\ORM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Image;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ImageFixtures
 */
class ImageFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * @param ObjectManager $manager
     * @return null
     */
    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/image.xml'));

        foreach ($xml->item as $item) {
            $image = new Image();
            $image->setName("$item->name");
            $image->setDescription("$item->description");
            $image->setPath("$item->path");

            if ("$item->parent" != '') {
                $image->setParentDirectory($this->getReference('directory-' . "$item->parent"));
            }

            $image->resetFullPath();

            $manager->persist($image);

            $this->addReference('image-' . $image->getFullPath(), $image);
        }
        $manager->flush();
    }

    /**
     * @param ContainerInterface|null $containerInterface
     * @return ImageFixtures
     */
    public function setContainer(ContainerInterface $containerInterface = null) : ImageFixtures
    {
        $this->container = $containerInterface;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOrder() : int
    {
        return 5;
    }
}
