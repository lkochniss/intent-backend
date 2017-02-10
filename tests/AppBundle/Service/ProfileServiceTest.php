<?php
/**
 * @package Test\AppBundle\Service
 */

namespace Test\AppBundle\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class ProfileServiceTest
 */
class ProfileServiceTest extends WebTestCase
{
    /**
     * @group service
     * @group profile
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.profile.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }

    /**
     * @group service
     * @group profile
     * @return null
     */
    public function testImport()
    {
        $status = $this->getContainer()->get('app.profile.service')->importEntities();
        $this->assertTrue($status);

        return null;
    }
}
