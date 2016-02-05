<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class ImageServiceTest
 */
class ImageServiceTest extends AbstractControllerTest
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.image.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }
}
