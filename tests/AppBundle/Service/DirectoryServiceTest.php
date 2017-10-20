<?php
/**
 * @package Test\AppBundle\Service
 */

namespace Test\AppBundle\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class DirectoryServiceTest
 */
class DirectoryServiceTest extends WebTestCase
{
    /**
     * @group service
     * @group image
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.directory.service')->exportEntities();
        $this->assertTrue($status);
    }

    /**
     * @group service
     * @group image
     */
    public function testImport()
    {
        $status = $this->getContainer()->get('app.directory.service')->importEntities();
        $this->assertTrue($status);
    }
}
