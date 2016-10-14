<?php
/**
 * @package AppBundle\DataFixtures\ORM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Page;
use AppBundle\SimpleXMLExtended;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class PageFixtures
 */
class PageFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * @param ObjectManager $manager Manager to save article.
     * @return null
     */
    public function load(ObjectManager $manager)
    {
        $xml = new SimpleXMLExtended(file_get_contents('web/export/page.xml'));

        foreach ($xml->item as $item) {
            $page = new Page();
            $page->setTitle("$item->title");
            $page->setContent("$item->content");
            $page->setPublished(intval("$item->published"));

            $manager->getRepository('AppBundle:Page')->save(
                $page,
                null
            );
        }

        $dataDirectory = __DIR__ . '/../../data/pages';
        $directory = opendir($dataDirectory);

        $count = 0;

        while (false !== $file = readdir($directory)) {
            if ('.' === substr($file, 0, 1)) {
                continue;
            }

            if ($file != 'imported') {
                $count++;
                $this->saveWordpressPage($manager, $dataDirectory . DIRECTORY_SEPARATOR . $file, $count);
            }
        }
        $manager->flush();

        return null;
    }

    /**
     * @param ObjectManager $manager Manager to save pages.
     * @param string        $path    Path to xml.
     * @return null
     */
    public function saveWordpressPage(ObjectManager $manager, $path)
    {
        $xml = new \SimpleXMLElement(file_get_contents($path));
        $pageRepository = $manager->getRepository('AppBundle:Page');

        foreach ($xml->channel->item as $item) {
            $namespaces = $item->getNameSpaces(true);
            $content = $item->children($namespaces['content']);

            $page = new Page();
            $page->setTitle("$item->title");
            $page->setPublished(true);
            $page->setContent("$content->encoded");

            $pageRepository->save($page);
        }

        $file = new File($path);
        $file->move(__DIR__ . '/../data/pages/imported');

        return null;
    }

    /**
     * @param ContainerInterface|null $containerInterface ContainerInterface.
     * @return $this
     */
    public function setContainer(ContainerInterface $containerInterface = null)
    {
        $this->container = $containerInterface;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOrder()
    {
        return 15;
    }
}
