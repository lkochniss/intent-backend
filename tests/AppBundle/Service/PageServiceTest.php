<?php
/**
 * @package Test\AppBundle\Service
 */

namespace Test\AppBundle\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class PageServiceTest
 */
class PageServiceTest extends WebTestCase
{
    /**
     * @group service
     * @group page
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.page.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }

    /**
     * @group service
     * @group page
     * @return null
     */
    public function testImport()
    {
        $status = $this->getContainer()->get('app.page.service')->importEntities();
        $this->assertTrue($status);

        return null;
    }
}
