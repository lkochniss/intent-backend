<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Tests\Controller\AbstractControllerTest;

/**
 * Class PageExportTest
 */
class PageExportTest extends AbstractControllerTest
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.page.service')->exportEntity();
        $this->assertTrue($status);

        return null;
    }
}
