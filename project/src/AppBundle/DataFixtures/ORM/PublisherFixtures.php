<?php

namespace AppBundle\DataFixtures\ORM;

use AppBUndle\Entity\Publisher;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PublisherFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $dataDirectory = __DIR__.'/../data/publishers';
        $directory = opendir($dataDirectory);

        $count = 0;

        while (false !== $file = readdir($directory)) {
            if ('.' === substr($file, 0, 1)) {
                continue;
            }

            $count++;

            $this->savePublisher($manager, $dataDirectory.DIRECTORY_SEPARATOR.$file, $count);
        }
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param $path
     * @param $count
     */
    public function savePublisher(ObjectManager $manager, $path, $count)
    {
        $publisherData = json_decode(file_get_contents($path), true);

        $publisher = new Publisher();
        $publisher->setName($publisherData['name']);
        $publisher->setDescription($publisherData['description']);
        $slug = preg_replace("/[^a-z0-9]+/", "-", strtolower($publisher->getName()));
        $publisher->setSlug($slug);

        $this->addReference('publisher-'.$publisher->getName(), $publisher);

        $manager->getRepository('AppBundle:Publisher')->save($publisher);
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
