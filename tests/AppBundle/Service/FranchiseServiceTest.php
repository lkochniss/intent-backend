<?php
/**
 * @package Test\AppBundle\Service
 */

namespace Test\AppBundle\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class FranchiseServiceTest
 */
class FranchiseServiceTest extends WebTestCase
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.franchise.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }

    /**
     * @return null
     */
    public function testImport()
    {
        $status = $this->getContainer()->get('app.franchise.service')->importEntities();
        $this->assertTrue($status);

        return null;
    }
}
