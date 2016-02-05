<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class GameServiceTest
 */
class GameServiceTest extends AbstractControllerTest
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.game.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }

    /**
     * @return null
     */
    public function testImport()
    {
        $status = $this->getContainer()->get('app.game.service')->importEntities();
        $this->assertTrue($status);

        return null;
    }
}
