<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class ProfileServiceTest
 */
class ProfileServiceTest extends WebTestCase
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
