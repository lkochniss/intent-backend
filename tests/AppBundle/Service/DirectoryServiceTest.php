<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class DirectoryServiceTest
 */
class DirectoryServiceTest extends AbstractControllerTest
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.directory.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }

    /**
     * @return null
     */
    public function testImport()
    {
        $status = $this->getContainer()->get('app.directory.service')->importEntities();
        $this->assertTrue($status);

        return null;
    }
}
