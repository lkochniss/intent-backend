<?php

namespace AppBundle\Service;

use AppBundle\Entity\Article;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityRepository;

/**
 * Class ArticleExport
 * @package AppBundle\Service
 */
class ArticleExport
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
        $articles = $this->repository->findAll();

        $xml = new SimpleXMLExtended('<xml />');

        /**
         * @var Article $article
         */
        foreach ($articles as $article) {
            $item = $xml->addChild('item');

            $item->title = null;
            $item->title->addCData($article->getTitle());

            $item->content = null;
            $item->content->addCData($article->getContent());

            $item->slideshow = null;
            $item->slideshow->addCData($article->isSlideshow());

            $item->published = null;
            $item->published->addCData($article->isPublished());

            $item->publishedAt = null;
            $item->publishedAt->addCData($article->getPublishAt()->format('Y-M-d H:i:s'));

            $item->author = null;
            $item->author->addCData($article->getCreatedBy()->getUsername());

            $item->related = null;
            $item->relatedType = null;
            if ($article->getRelated()) {
                $item->related->addCData($article->getRelated()->getSlug());
                $item->relatedType->addCData($article->getRelated()->getType());
            }

            $item->category = null;
            if ($article->getCategory()) {
                $item->category->addCData('category-'. $article->getCategory()->getSlug());
            }

            $item->event = null;
            if ($article->getEvent()) {
                $item->event->addCData('event-'. $article->getEvent()->getSlug());
            }

            $item->thumbnail = null;
            if ($article->getThumbnail()) {
                $item->thumbnail->addCData('image-'. $article->getThumbnail()->getFullPath());
            }
        }

        $xml->saveXML('web/export/article.xml');
    }
}
