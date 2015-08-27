<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Franchise;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FranchiseFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $dataDirectory = __DIR__.'/../data/franchises';
        $directory = opendir($dataDirectory);

        $count = 0;

        while (false !== $file = readdir($directory)) {
            if ('.' === substr($file, 0, 1)) {
                continue;
            }

            $count++;

            $this->saveFranchise($manager, $dataDirectory.DIRECTORY_SEPARATOR.$file, $count);
        }
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param $path
     * @param $count
     */
    public function saveFranchise(ObjectManager $manager, $path, $count)
    {
        $franchiseData = json_decode(file_get_contents($path), true);

        $franchise = new Franchise();
        $franchise->setName($franchiseData['name']);
        $franchise->setDescription($franchiseData['description']);
        $slug = preg_replace("/[^a-z0-9]+/", "-", strtolower($franchise->getName()));
        $franchise->setSlug($slug);

        if($franchiseData['publisher']){
            $franchise->setPublisher($this->getReference('publisher-'.$franchiseData['publisher']));
        }

        if($franchiseData['studio']){
            $franchise->setStudio($this->getReference('studio-'.$franchiseData['studio']));
        }

        $this->addReference('franchise-'.$franchise->getName(), $franchise);

        $manager->getRepository('AppBundle:Franchise')->save($franchise);
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
