<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Tests\Controller\AbstractControllerTest;

/**
 * Class StudioExportTest
 */
class StudioExportTest extends AbstractControllerTest
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.studio.service')->exportEntity();
        $this->assertTrue($status);

        return null;
    }
}
