<?php
/**
 * @package Test\AppBundle\Service
 */

namespace Test\AppBundle\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class CategoryServiceTest
 */
class CategoryServiceTest extends WebTestCase
{
    /**
     * @group service
     * @group category
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.category.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }

    /**
     * @group service
     * @group category
     * @return null
     */
    public function testImport()
    {
        $status = $this->getContainer()->get('app.category.service')->importEntities();
        $this->assertTrue($status);

        return null;
    }
}
