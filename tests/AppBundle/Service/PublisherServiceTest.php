<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use Test\AppBundle\Controller\AbstractControllerTest;

/**
 * Class PublisherServiceTest
 */
class PublisherServiceTest extends AbstractControllerTest
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.publisher.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }
}
