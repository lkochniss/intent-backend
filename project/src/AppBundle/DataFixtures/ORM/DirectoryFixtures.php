<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Directory;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DirectoryFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/directory.xml'));

        foreach ($xml->item as $item) {
            $directory = new Directory();
            $directory->setName("$item->name");
            $directory->setPath("$item->path");

            if("$item->parent" != ""){
                $directory->setParentDirectory($this->getReference('directory-'."$item->parent"));
            }

            $manager->getRepository('AppBundle:Directory')->save(
                $directory
            );
            $this->addReference('directory-'.$directory->getName(), $directory);
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
        return 4;
    }
}