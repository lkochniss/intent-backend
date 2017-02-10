<?php
/**
 * @package Test\AppBundle\Service
 */

namespace Test\AppBundle\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class ImageServiceTest
 */
class ImageServiceTest extends WebTestCase
{
    /**
     * @group service
     * @group image
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.image.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }

    /**
     * @group service
     * @group image
     * @return null
     */
    public function testImport()
    {
        $status = $this->getContainer()->get('app.image.service')->importEntities();
        $this->assertTrue($status);

        return null;
    }
}
