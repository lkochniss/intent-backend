<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Page;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class PageService
 */
class PageService
{
    /**
     * @var \AppBundle\Repository\PageRepository
     */
    private $repository;

    /**
     * @param EntityManager $manager Get the entityManager.
     */
    public function __construct(EntityManager $manager)
    {
        $this->repository = $manager->getRepository('AppBundle:Page');
    }

    /**
     * @return boolean
     */
    public function exportEntities()
    {
        $pages = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Page $page
         */
        foreach ($pages as $page) {
            $item = $xml->addChild('item');

            $item->title = null;
            $item->title->addCData($page->getTitle());

            $item->content = null;
            $item->content->addCData($page->getContent());

            $item->published = null;
            $item->published->addCData($page->isPublished());
        }

        $xml->saveXML('web/export/page.xml');

        return true;
    }

    /**
     * @param string $path The import path.
     * @return boolean
     */
    public function importEntities($path = 'web/export/page.xml')
    {
        $xml = new SimpleXMLExtended(file_get_contents($path));

        foreach ($xml->item as $item) {
            $page = new Page();
            $page->setTitle("$item->title");
            $page->setContent(intval("$item->content"));
            $page->setPublished(intval("$item->published"));

            $this->repository->save($page);
        }

        return true;
    }
}
