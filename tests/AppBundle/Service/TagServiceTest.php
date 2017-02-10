<?php
/**
 * @package Test\AppBundle\Service
 */

namespace Test\AppBundle\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class TagServiceTest
 */
class TagServiceTest extends WebTestCase
{
    /**
     * @group service
     * @group tag
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.tag.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }

    /**
     * @group service
     * @group tag
     * @return null
     */
    public function testImport()
    {
        $status = $this->getContainer()->get('app.tag.service')->importEntities();
        $this->assertTrue($status);

        return null;
    }
}
