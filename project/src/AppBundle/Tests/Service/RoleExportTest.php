<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Tests\Controller\AbstractControllerTest;

/**
 * Class RoleExportTest
 */
class RoleExportTest extends AbstractControllerTest
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.role.service')->exportEntity();
        $this->assertTrue($status);

        return null;
    }
}
