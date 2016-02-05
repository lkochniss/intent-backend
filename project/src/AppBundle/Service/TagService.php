<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Category;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class TagService
 */
class TagService
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
        $this->repository = $manager->getRepository('AppBundle:Tag');
    }

    /**
     * @return boolean
     */
    public function exportEntities()
    {
        $categories = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Category $category
         */
        foreach ($categories as $category) {
            $item = $xml->addChild('item');

            $item->name = null;
            $item->name->addCData($category->getName());

            $item->published = null;
            $item->published->addCData($category->isPublished());
        }

        $xml->saveXML('web/export/tag.xml');

        return true;
    }
}
