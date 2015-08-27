<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Game;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GameFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $dataDirectory = __DIR__.'/../data/games';
        $directory = opendir($dataDirectory);

        $count = 0;

        while (false !== $file = readdir($directory)) {
            if ('.' === substr($file, 0, 1)) {
                continue;
            }

            $count++;

            $this->saveGame($manager, $dataDirectory.DIRECTORY_SEPARATOR.$file, $count);
        }
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param $path
     * @param $count
     */
    public function saveGame(ObjectManager $manager, $path, $count)
    {
        $gameData = json_decode(file_get_contents($path), true);

        $game = new Game();
        $game->setName($gameData['name']);
        $game->setDescription($gameData['description']);
        $slug = preg_replace("/[^a-z0-9]+/", "-", strtolower($game->getName()));
        $game->setSlug($slug);
        if (($gameData['studio'])){
            $game->setStudio($this->getReference('studio-'.$gameData['studio']));
        }
        if (($gameData['franchise'])){
            $game->setFranchise($this->getReference('franchise-'.$gameData['franchise']));
        }

        $this->addReference('game-'.$game->getName(), $game);

        $manager->getRepository('AppBundle:Game')->save($game);
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
        return 6;
    }
}
