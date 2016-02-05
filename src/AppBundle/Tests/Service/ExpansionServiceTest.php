<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Tests\Controller\AbstractControllerTest;

/**
 * Class ExpansionServiceTest
 */
class ExpansionServiceTest extends AbstractControllerTest
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.expansion.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }

    /**
     * @return null
     */
    public function testImport()
    {
        $status = $this->getContainer()->get('app.expansion.service')->importEntities();
        $this->assertTrue($status);

        return null;
    }
}
