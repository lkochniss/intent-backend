<?php

namespace AppBundle\DataFixtures\ORM;

use AppBUndle\Entity\Category;
use AppBundle\Entity\Directory;
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
        $dataDirectory = __DIR__.'/../data/directories';
        $directory = opendir($dataDirectory);

        $count = 0;

        while (false !== $file = readdir($directory)) {
            if ('.' === substr($file, 0, 1)) {
                continue;
            }

            $count++;

            $this->SaveDirectory($manager, $dataDirectory.DIRECTORY_SEPARATOR.$file, $count);
        }
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param $path
     * @param $count
     */
    public function SaveDirectory(ObjectManager $manager, $path, $count)
    {
        $directoryData = json_decode(file_get_contents($path), true);

        $directory = new Directory();
        $directory->setName($directoryData['name']);

        $this->addReference('directory-'.$directory->getName(), $directory);

        $manager->getRepository('AppBundle:Directory')->save($directory);
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
        return 3;
    }
}
