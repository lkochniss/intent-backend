<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Game;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class GameService
 */
class GameService
{
    /** @var  EntityManager */
    private $manager;

    /** @var  EntityRepository */
    private $repository;

    /**
     * @param EntityManager $manager Get the entityManager.
     */
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
        $this->repository = $manager->getRepository('AppBundle:Game');
    }

    /**
     * @param string $path The export path.
     * @return boolean
     */
    public function exportEntities($path = 'web/export/game.xml')
    {
        $games = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Game $game
         */
        foreach ($games as $game) {
            $item = $xml->addChild('item');

            $item->name = null;
            $item->name->addCData($game->getName());

            $item->description = null;
            $item->description->addCData($game->getDescription());

            $item->published = null;
            $item->published->addCData($game->isPublished());

            $item->backgroundLink = null;
            $item->backgroundLink->addCData($game->getBackgroundLink());

            $item->franchise = null;
            if ($game->getFranchise()) {
                $item->franchise->addCData($game->getFranchise()->getSlug());
            }

            $item->studio = null;
            if ($game->getStudio()) {
                $item->studio->addCData($game->getStudio()->getSlug());
            }

            $item->backgroundImage = null;
            if ($game->getBackgroundImage()) {
                $item->backgroundImage->addCData($game->getBackgroundImage()->getFullPath());
            }

            $item->thumbnail = null;
            if ($game->getThumbnail()) {
                $item->thumbnail->addCData($game->getThumbnail()->getFullPath());
            }
        }

        $xml->saveXML($path);

        return true;
    }

    /**
     * @param string $path The import path.
     * @return boolean
     */
    public function importEntities($path = 'web/export/game.xml')
    {
        $xml = new SimpleXMLExtended(file_get_contents($path));

        foreach ($xml->item as $item) {
            $game = new Game();
            $game->setName("$item->name");
            $game->setDescription("$item->description");
            $game->setPublished(intval("$item->published"));
            $game->setBackgroundLink("$item->backgroundLink");

            if ("$item->franchise" != '') {
                $game->setFranchise(
                    $this->manager->getRepository('AppBundle:Franchise')->findOneBy(
                        array(
                            'slug' => "$item->franchise"
                        )
                    )
                );
            }

            if ("$item->studio" != '') {
                $game->setStudio(
                    $this->manager->getRepository('AppBundle:Studio')->findOneBy(
                        array(
                            'slug' => "$item->studio"
                        )
                    )
                );
            }

            if ("$item->backgroundImage" != '') {
                $game->setBackgroundImage(
                    $this->manager->getRepository('AppBundle:Image')->findOneBy(
                        array(
                            'fullPath' => "$item->backgroundImage"
                        )
                    )
                );
            }

            if ("$item->thumbnail" != '') {
                $game->setBackgroundImage(
                    $this->manager->getRepository('AppBundle:Image')->findOneBy(
                        array(
                            'fullPath' => "$item->thumbnail"
                        )
                    )
                );
            }

            $this->repository->save($game);
        }

        return true;
    }
}
