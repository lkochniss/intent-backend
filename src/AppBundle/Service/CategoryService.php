<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Category;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityManager;

/**
 * Class CategoryService
 */
class CategoryService
{
    /**
     * @var \AppBundle\Repository\CategoryRepository
     */
    private $repository;

    /**
     * @param EntityManager $manager Get the entityManager.
     */
    public function __construct(EntityManager $manager)
    {
        $this->repository = $manager->getRepository('AppBundle:Category');
    }

    /**
     * @param string $path The export path.
     * @return boolean
     */
    public function exportEntities($path = 'web/export/category.xml')
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

        $xml->saveXML($path);

        return true;
    }

    /**
     * @param string $path The import path.
     * @return boolean
     */
    public function importEntities($path = 'web/export/category.xml')
    {
        $xml = new SimpleXMLExtended(file_get_contents($path));

        foreach ($xml->item as $item) {
            $category = new Category();
            $category->setName("$item->name");
            $category->setPublished(intval("$item->published"));
            $category->setPriority(intval("$item->priority"));

            $this->repository->save($category);
        }

        return true;
    }
}
