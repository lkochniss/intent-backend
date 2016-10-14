<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class PublisherServiceTest
 */
class PublisherServiceTest extends WebTestCase
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.publisher.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }
}
