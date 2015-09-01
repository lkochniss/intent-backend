<?php

namespace AppBundle\Service;

use AppBundle\Entity\Page;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class PageExport
 * @package AppBundle\Service
 */
class PageExport
{
    /** @var  EntityRepository */
    private $repository;

    /**
     * @param EntityRepository $repository
     */
    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

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
            $item->publishedAt->addCData($page->getPublishAt()->format('Y-M-d H:i:s'));
        }

        $xml->saveXML('web/export/page.xml');
    }
}