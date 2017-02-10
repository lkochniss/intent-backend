<?php
/**
 * @package Test\AppBundle\Service
 */

namespace Test\AppBundle\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class EventServiceTest
 */
class EventServiceTest extends WebTestCase
{
    /**
     * @group service
     * @group event
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.event.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }

    /**
     * @group service
     * @group event
     * @return null
     */
    public function testImport()
    {
        $status = $this->getContainer()->get('app.event.service')->importEntities();
        $this->assertTrue($status);

        return null;
    }
}
