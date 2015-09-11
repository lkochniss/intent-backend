<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Page;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class PageExport
 */
class PageExport
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

            $item->publishedAt = null;
            if (!is_null($page->getPublishAt())) {
                $item->publishedAt->addCData($page->getPublishAt()->format('Y-M-d H:i:s'));
            }
        }

        $xml->saveXML('web/export/page.xml');

        return true;
    }
}
