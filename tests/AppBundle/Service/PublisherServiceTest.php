<?php
/**
 * @package Test\AppBundle\Service
 */

namespace Test\AppBundle\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class PublisherServiceTest
 */
class PublisherServiceTest extends WebTestCase
{
    /**
     * @group service
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.publisher.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }

    /**
     * @group service
     * @return null
     */
    public function testImport()
    {
        $status = $this->getContainer()->get('app.publisher.service')->importEntities();
        $this->assertTrue($status);

        return null;
    }
}
