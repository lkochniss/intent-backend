<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Tests\Controller\AbstractControllerTest;

/**
 * Class ProfileServiceTest
 */
class ProfileServiceTest extends AbstractControllerTest
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.profile.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }
}
