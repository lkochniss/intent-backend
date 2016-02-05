<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Expansion;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class ExpansionService
 */
class ExpansionService
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
        $this->repository = $manager->getRepository('AppBundle:Expansion');
    }

    /**
     * @param string $path The export path.
     * @return boolean
     */
    public function exportEntities($path = 'web/export/expansion.xml')
    {
        $expansions = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Expansion $expansion
         */
        foreach ($expansions as $expansion) {
            $item = $xml->addChild('item');

            $item->name = null;
            $item->name->addCData($expansion->getName());

            $item->description = null;
            $item->description->addCData($expansion->getDescription());

            $item->published = null;
            $item->published->addCData($expansion->isPublished());

            $item->backgroundLink = null;
            $item->backgroundLink->addCData($expansion->getBackgroundLink());

            $item->game = null;
            if ($expansion->getGame()) {
                $item->game->addCData('game-' . $expansion->getGame()->getSlug());
            }

            $item->backgroundImage = null;
            if ($expansion->getBackgroundImage()) {
                $item->backgroundImage->addCData('image-' . $expansion->getBackgroundImage()->getFullPath());
            }

            $item->thumbnail = null;
            if ($expansion->getThumbnail()) {
                $item->thumbnail->addCData('image-' . $expansion->getThumbnail()->getFullPath());
            }
        }

        $xml->saveXML($path);

        return true;
    }

    /**
     * @param string $path The import path.
     * @return boolean
     */
    public function importEntities($path = 'web/export/expansion.xml')
    {
        $xml = new SimpleXMLExtended(file_get_contents($path));

        foreach ($xml->item as $item) {
            $expansion = new Expansion();
            $expansion->setName("$item->name");
            $expansion->setDescription("$item->description");
            $expansion->setPublished(intval("$item->published"));
            $expansion->setBackgroundLink("$item->backgroundLink");

            if ("$item->game" != '') {
                $expansion->setGame(
                    $this->manager->getRepository('AppBundle:Game')->findOneBy(
                        array(
                            'slug' => "$item->game"
                        )
                    )
                );
            }

            if ("$item->backgroundImage" != '') {
                $expansion->setBackgroundImage(
                    $this->manager->getRepository('AppBundle:Image')->findOneBy(
                        array(
                            'fullPath' => "$item->backgroundImage"
                        )
                    )
                );
            }

            if ("$item->thumbnail" != '') {
                $expansion->setBackgroundImage(
                    $this->manager->getRepository('AppBundle:Image')->findOneBy(
                        array(
                            'fullPath' => "$item->thumbnail"
                        )
                    )
                );
            }

            $this->repository->save($expansion);
        }

        return true;
    }
}
