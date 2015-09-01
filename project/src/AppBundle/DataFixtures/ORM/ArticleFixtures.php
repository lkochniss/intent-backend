<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Article;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;

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
            $article->setPublishAt(new \DateTime("$item->publisehdAt"));
            if("$item->relatedType" != ""){
                $article->setRelated($this->getReference("$item->relatedType".'-'."$item->related"));
            }

            if("$item->category" != ""){
                $article->setCategory($this->getReference("$item->category"));
            }

            if("$item->event" != ""){
                $article->setEvent($this->getReference("$item->event"));
            }
            $manager->getRepository('AppBundle:Article')->save(
                $article,
                $this->getReference('user-'."$item->author")
            );
        }
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
        return 12;
    }
}
