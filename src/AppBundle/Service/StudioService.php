<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Studio;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class StudioService
 */
class StudioService
{
    /**
     * @var \AppBundle\Repository\StudioRepository
     */
    private $repository;

    /**
     * @param EntityManager $manager Get the entityManager.
     */
    public function __construct(EntityManager $manager)
    {
        $this->repository = $manager->getRepository('AppBundle:Studio');
    }

    /**
     * @return boolean
     */
    public function exportEntities()
    {
        $studios = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');


        /**
         * @var Studio $studio
         */
        foreach ($studios as $studio) {
            $item = $xml->addChild('item');

            $item->name = null;
            $item->name->addCData($studio->getName());

            $item->description = null;
            $item->description->addCData($studio->getDescription());

            $item->published = null;
            $item->published->addCData($studio->isPublished());

            $item->backgroundLink = null;
            $item->backgroundLink->addCData($studio->getBackgroundLink());

            $item->backgroundImage = null;
            if ($studio->getBackgroundImage()) {
                $item->backgroundImage->addCData($studio->getBackgroundImage()->getFullPath());
            }

            $item->thumbnail = null;
            if ($studio->getThumbnail()) {
                $item->thumbnail->addCData($studio->getThumbnail()->getFullPath());
            }
        }

        $xml->saveXML('web/export/studio.xml');

        return true;
    }

    /**
     * @param string $path The import path.
     * @return boolean
     */
    public function importEntities($path = 'web/export/studio.xml')
    {
        $xml = new SimpleXMLExtended(file_get_contents($path));

        foreach ($xml->item as $item) {
            $studio = new Studio();
            $studio->setName("$item->name");
            $studio->setDescription("$item->description");
            $studio->setPublished(intval("$item->published"));
            $studio->setBackgroundLink(intval("$item->backgroundLink"));

            if ("$item->backgroundImage" != '') {
                $studio->setBackgroundImage(
                    $this->manager->getRepository('AppBundle:Image')->findOneBy(
                        array(
                            'fullPath' => "$item->backgroundImage"
                        )
                    )
                );
            }

            if ("$item->thumbnail" != '') {
                $studio->setBackgroundImage(
                    $this->manager->getRepository('AppBundle:Image')->findOneBy(
                        array(
                            'fullPath' => "$item->thumbnail"
                        )
                    )
                );
            }

            $this->repository->save($studio);
        }

        return true;
    }
}
