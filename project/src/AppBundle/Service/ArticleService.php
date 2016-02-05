<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Entity\Article;
use AppBundle\SimpleXMLExtended;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class ArticleService
 */
class ArticleService
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
        $this->repository = $manager->getRepository('AppBundle:Article');
    }

    /**
     * @return boolean
     */
    public function exportEntities()
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
                $item->relatedType->addCData(get_class($article->getRelated()));
            }

            $item->category = null;
            if ($article->getCategory()) {
                $item->category->addCData('category-' . $article->getCategory()->getSlug());
            }

            $item->event = null;
            if ($article->getEvent()) {
                $item->event->addCData('event-' . $article->getEvent()->getSlug());
            }

            $item->thumbnail = null;
            if ($article->getThumbnail()) {
                $item->thumbnail->addCData('image-' . $article->getThumbnail()->getFullPath());
            }

            if (is_null($article->getTags())) {
                $item->tag = null;
            }
            foreach ($article->getTags() as $tag) {
                $item->addChild('tag', 'tag-' . $tag->getSlug());
            }
        }

        $xml->saveXML('web/export/article.xml');

        return true;
    }

    /**
     * @param string $path The import path.
     * @return boolean
     */
    public function importEntities($path = 'web/export/article.xml')
    {
        $xml = new SimpleXMLExtended(file_get_contents($path));

        foreach ($xml->item as $item) {
            $article = new Article();
            $article->setTitle("$item->title");
            $article->setContent("$item->content");
            $article->setSlideshow(intval("$item->slideshow"));
            $article->setPublished(intval("$item->published"));
            $article->setPublishAt(new \DateTime("$item->publishedAt"));

            if ("$item->relatedType" != '') {
                $article->setRelated(
                    $this->manager->getRepository("$item->relatedType")->findOneBy(
                        array(
                            'slug' => "$item->related"
                        )
                    )
                );
            }

            if ("$item->category" != '') {
                $article->setCategory(
                    $this->manager->getRepository('AppBundle:Category')->findOneBy(
                        array(
                            'slug' =>"$item->category"
                        )
                    )
                );
            }

            if ("$item->event" != '') {
                $article->setEvent(
                    $this->manager->getRepository('AppBundle:Event')->findOneBy(
                        array(
                            'slug' => "$item->event"
                        )
                    )
                );
            }

            if ("$item->thumbnail" != '') {
                $article->setThumbnail(
                    $this->manager->getRepository('AppBundle:Image')->findOneBy(
                        array(
                            'slug' => "$item->thumbnail"
                        )
                    )
                );
            }

            foreach ($item->tag as $tag) {
                $article->addTag(
                    $this->manager->getRepository('AppBundle:Tag')->findOneBy(
                        array(
                            'slug' => "$tag"
                        )
                    )
                );
            }

            $this->repository->save(
                $article,
                $this->manager->getRepository('AppBundle:User')->findOneBy(
                    array(
                        'username' => "$item->author"
                    )
                )
            );
        }

        return true;
    }
}
