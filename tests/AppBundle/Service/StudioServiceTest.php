<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class StudioServiceTest
 */
class StudioServiceTest extends WebTestCase
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.studio.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }
}
