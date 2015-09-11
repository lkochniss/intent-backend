<?php
/**
 * @package AppBundle\Tests\Controller
 */

namespace AppBundle\Tests\Controller;

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
        $this->pageResponse('GET', '');

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
    protected function checkIfOneContentExist(Crawler $crawler, $needle)
    {
        $this->assertEquals(
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
     * @param integer $number  The number of minimum Elements.
     * @return null
     */
    protected function checkIfContentExist(Crawler $crawler, $needle, $number)
    {
        $this->assertGreaterThan(
            $number,
            $crawler
                ->filter($needle)
                ->count(),
            sprintf('%s not found', $needle)
        );

        return null;
    }
}
