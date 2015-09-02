<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Article;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\File;

class ArticleFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/article.xml'));

        foreach ($xml->item as $item) {
            $article = new Article();
            $article->setTitle("$item->title");
            $article->setContent("$item->content");
            $article->setSlideshow(intval("$item->slideshow"));
            $article->setPublished(intval("$item->published"));
            $article->setPublishAt(new \DateTime("$item->publishedAt"));
            if ("$item->relatedType" != "") {
                $article->setRelated($this->getReference("$item->relatedType".'-'."$item->related"));
            }

            if ("$item->category" != "") {
                $article->setCategory($this->getReference("$item->category"));
            }

            if ("$item->event" != "") {
                $article->setEvent($this->getReference("$item->event"));
            }
            $manager->getRepository('AppBundle:Article')->save(
                $article,
                $this->getReference('user-'."$item->author")
            );
        }

        $dataDirectory = __DIR__.'/../data/articles';
        $directory = opendir($dataDirectory);

        $count = 0;

        while (false !== $file = readdir($directory)) {
            if ('.' === substr($file, 0, 1)) {
                continue;
            }

            if ($file != 'imported') {
                $count++;
                $this->saveWordpressArticle($manager, $dataDirectory.DIRECTORY_SEPARATOR.$file, $count);
            }
        }
        $manager->flush();
    }


    /**
     * @param ObjectManager $manager
     * @param $path
     * @param $count
     */
    public function saveWordpressArticle(ObjectManager $manager, $path, $count)
    {
        $xml = new \SimpleXMLElement(file_get_contents($path));
        foreach ($xml->channel->item as $item) {

            $namespaces = $item->getNameSpaces(true);
            $dc = $item->children($namespaces['dc']);
            $content = $item->children($namespaces['content']);
            $wp = $item->children($namespaces['wp']);

            $article = new Article();
            $article->setTitle("$item->title");
            $article->setPublishAt(new \DateTime("$wp->post_date"));
            $article->setPublished(true);
            $article->setContent("$content->encoded");
            foreach ($item->category as $category) {
                foreach ($category->attributes() as $a => $b) {
                    if ($b == 'category') {
                        $article->setCategory(
                            $this->getReference(
                                'category-'.preg_replace("/[^a-z0-9]+/", "-", strtolower("$category"))
                            )
                        );
                    }
                }
            }

            $manager->getRepository('AppBundle:Article')->save(
                $article,
                $this->getReference('user-'."$dc->creator")
            );
        }

        $file = new File($path);
        $file->move(__DIR__.'/../data/articles/imported');
    }

    /**
     * @param ContainerInterface|null $containerInterface
     */
    public
    function setContainer(
        ContainerInterface $containerInterface = null
    ) {
        $this->container = $containerInterface;
    }

    /**
     * @return int
     */
    public
    function getOrder()
    {
        return 13;
    }
}
