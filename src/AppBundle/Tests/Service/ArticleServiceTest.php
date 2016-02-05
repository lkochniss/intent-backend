<?php
/**
 * @package AppBundle\Service
 */

namespace AppBundle\Service;

use AppBundle\Tests\Controller\AbstractControllerTest;

/**
 * Class ArticleServiceTest
 */
class ArticleServiceTest extends AbstractControllerTest
{
    /**
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.article.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }

    /**
     * @return null
     */
    public function testImport()
    {
        $status = $this->getContainer()->get('app.article.service')->importEntities();
        $this->assertTrue($status);

        return null;
    }
}
