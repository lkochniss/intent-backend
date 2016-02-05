<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class TagServiceTest
 */
class TagServiceTest extends AbstractControllerTest
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.tag.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }
}
