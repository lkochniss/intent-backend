<?php
/**
 * @package Test\AppBundle\Controller
 */

namespace Test\AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Client;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class AbstractControllerTest
 *
 * @group legacy
 */
class AbstractControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @return $this
     */
    public function setUp()
    {
        $this->client = static::createClient(
            array(),
            array(
                'PHP_AUTH_USER' => 'admin',
                'PHP_AUTH_PW' => 'admin',
            )
        );

        $this->entityManager = static::$kernel
            ->getContainer()
            ->get('doctrine')
            ->getManager();

        return $this;
    }

    /**
     * @return null
     */
    public function testIsGeneralReachable()
    {
        $crawler = $this->pageResponse('GET', '');

        /**
         * Adminbar
         */
        $this->checkIfOneContentExist($crawler, 'a[href="/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/article/create"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/logout"]');

        /**
         * Sidebar
         */
        $this->checkIfOneContentExist($crawler, 'a[href="/article/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/page/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/category/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/tag/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/event/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/publisher/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/studio/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/franchise/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/game/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/expansion/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/filemanager"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/user/"]');
        $this->checkIfOneContentExist($crawler, 'a[href="/profile/"]');

        return null;
    }

    /**
     * @return Client
     */
    protected function getClient()
    {
        return $this->client;
    }

    /**
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param string $method Type of method (POST, GET).
     * @param string $url    Which url should be checked.
     * @return Crawler
     */
    protected function pageResponse($method, $url)
    {
        $crawler = $this->client->request($method, $url);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        return $crawler;
    }

    /**
     * @param Crawler $crawler The crawler with the Response.
     * @param string  $needle  The needle to search after.
     * @return null
     */
    protected function checkIfContentExist(Crawler $crawler, $needle)
    {
        $this->assertGreaterThanOrEqual(
            1,
            $crawler
                ->filter($needle)
                ->count(),
            sprintf('%s not found', $needle)
        );

        return null;
    }

    /**
     * @param Crawler $crawler The crawler with the Response.
     * @param string  $needle  The needle to search after.
     * @return null
     */
    protected function checkIfOneContentExist(Crawler $crawler, $needle)
    {
        $this->assertEquals(
            1,
            $crawler
                ->filter($needle)
                ->count(),
            sprintf('%s not found or too many', $needle)
        );

        return null;
    }

    /**
     * @param Crawler $crawler The crawler with the Response.
     * @param string  $needle  The needle to search after.
     * @param integer $number  The number of minimum Elements.
     * @return null
     */
    protected function checkIfNumberOfContentExist(Crawler $crawler, $needle, $number)
    {
        $this->assertGreaterThanOrEqual(
            $number,
            $crawler
                ->filter($needle)
                ->count(),
            sprintf('%s not found or wrong number', $needle)
        );

        return null;
    }
}
