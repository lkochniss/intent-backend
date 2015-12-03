<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Category;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class CategoryExport
 */
class CategoryExport
{
    /** @var  EntityRepository */
    private $repository;

    /**
     * @param EntityRepository $repository Get the entity repository.
     */
    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return boolean
     */
    public function exportEntity()
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

            $item->priority = null;
            $item->priority->addCData($category->getPriority());

            $item->published = null;
            $item->published->addCData($category->isPublished());
        }

        $xml->saveXML('web/export/category.xml');

        return true;
    }
}
