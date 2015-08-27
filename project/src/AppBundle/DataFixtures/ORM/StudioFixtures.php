<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Studio;
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
        $dataDirectory = __DIR__.'/../data/studios';
        $directory = opendir($dataDirectory);

        $count = 0;

        while (false !== $file = readdir($directory)) {
            if ('.' === substr($file, 0, 1)) {
                continue;
            }

            $count++;

            $this->saveStudio($manager, $dataDirectory.DIRECTORY_SEPARATOR.$file, $count);
        }
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param $path
     * @param $count
     */
    public function saveStudio(ObjectManager $manager, $path, $count)
    {
        $studioData = json_decode(file_get_contents($path), true);

        $studio = new Studio();
        $studio->setName($studioData['name']);
        $studio->setDescription($studioData['description']);
        $slug = preg_replace("/[^a-z0-9]+/", "-", strtolower($studio->getName()));
        $studio->setSlug($slug);

        $this->addReference('studio-'.$studio->getName(), $studio);

        $manager->getRepository('AppBundle:Studio')->save($studio);
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
