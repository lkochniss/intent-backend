<?php
/**
 * @package Test\AppBundle
 */

namespace Test\AppBundle;

use Doctrine\ORM\EntityManager;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Client;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class AbstractWebTest
 *
 * @group legacy
 */
abstract class AbstractWebTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @return Client
     */
    protected function getClient()
    {
        return $this->client;
    }

    /**
     * @param $username
     * @param $password
     * @return Client
     */
    protected function setClient($username, $password)
    {
        $this->client = static::createClient(
            array(),
            array(
                'PHP_AUTH_USER' => $username,
                'PHP_AUTH_PW' => $password,
            )
        );

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
     * @return \Doctrine\Common\Persistence\ObjectManager|EntityManager|object
     */
    protected function setEntityManager()
    {
        $this->entityManager = static::$kernel
            ->getContainer()
            ->get('doctrine')
            ->getManager();

        return $this->entityManager;
    }

    /**
     * @param string $method Type of method (POST, GET).
     * @param string $url    Which url should be checked.
     * @return Crawler
     */
    protected function pageResponse($method, $url, $statusCode = 200)
    {
        $crawler = $this->client->request($method, $url);
        $this->assertEquals($statusCode, $this->client->getResponse()->getStatusCode());

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
        $this->assertEquals(
            $number,
            $crawler
                ->filter($needle)
                ->count(),
            sprintf('%s not found or wrong number', $needle)
        );

        return null;
    }
}
