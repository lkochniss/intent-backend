<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Tests\Controller\AbstractControllerTest;

/**
 * Class ImageExportTest
 */
class ImageExportTest extends AbstractControllerTest
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.image.service')->exportEntity();
        $this->assertTrue($status);

        return null;
    }
}
