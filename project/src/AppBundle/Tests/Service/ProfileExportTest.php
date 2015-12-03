<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Tests\Controller\AbstractControllerTest;

/**
 * Class ProfileExportTest
 */
class ProfileExportTest extends AbstractControllerTest
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.profile.service')->exportEntity();
        $this->assertTrue($status);

        return null;
    }
}
