<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Page;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class PageService
 */
class PageService
{
    /** @var  EntityRepository */
    private $repository;

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
}
