<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Directory;
use AppBundle\Entity\Image;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ImageFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/image.xml'));

        foreach ($xml->item as $item) {
            $image = new Image();
            $image->setName("$item->name");
            $image->setDescription("$item->description");
            $image->setPath("$item->path");

            if("$item->parent" != ""){
                $image->setParentDirectory($this->getReference('directory-'."$item->parent"));
            }

            $manager->getRepository('AppBundle:Image')->save(
                $image
            );
            $this->addReference('image-'.$image->getName(), $image);
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
        return 5;
    }
}
