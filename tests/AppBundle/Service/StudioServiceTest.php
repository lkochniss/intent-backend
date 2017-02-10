<?php
/**
 * @package Test\AppBundle\Service
 */

namespace Test\AppBundle\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class StudioServiceTest
 */
class StudioServiceTest extends WebTestCase
{
    /**
     * @group service
     * @group studio
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.studio.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }

    /**
     * @group service
     * @group studio
     * @return null
     */
    public function testImport()
    {
        $status = $this->getContainer()->get('app.studio.service')->importEntities();
        $this->assertTrue($status);

        return null;
    }
}
