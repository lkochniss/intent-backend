<?php
/**
 * @package AppBundle\DataFixtures\ORM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Game;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class GameFixtures
 */
class GameFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * @param ObjectManager $manager Manager to save game.
     * @return null
     */
    public function load(ObjectManager $manager)
    {
//        $xml = new SimpleXMLExtended(file_get_contents('web/export/game.xml'));
//
//        foreach ($xml->item as $item) {
//            $game = new Game();
//            $game->setName("$item->name");
//            $game->setDescription("$item->description");
//            $game->setPublished(intval("$item->published"));
//            $game->setBackgroundLink("$item->backgroundLink");
//
//            if ("$item->franchise" != '') {
//                $game->setFranchise($this->getReference("$item->franchise"));
//            }
//
//            if ("$item->studio" != '') {
//                $game->setStudio($this->getReference("$item->studio"));
//            }
//
//            if ("$item->backgroundImage" != '') {
//                $game->setBackgroundImage($this->getReference("$item->backgroundImage"));
//            }
//
//            if ("$item->thumbnail" != '') {
//                $game->setThumbnail($this->getReference("$item->thumbnail"));
//            }
//
//
//            $manager->getRepository('AppBundle:Game')->save(
//                $game
//            );
//
//            $this->addReference('game-' . $game->getSlug(), $game);
//        }

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
        return 9;
    }
}
