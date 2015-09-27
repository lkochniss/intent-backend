<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Tests\Controller\AbstractControllerTest;

/**
 * Class FranchiseExportTest
 */
class FranchiseExportTest extends AbstractControllerTest
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.franchise.service')->exportEntity();
        $this->assertTrue($status);

        return null;
    }
}
