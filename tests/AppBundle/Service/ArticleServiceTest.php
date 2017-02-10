<?php
/**
 * @package Test\AppBundle\Service
 */

namespace Test\AppBundle\Service;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class ArticleServiceTest
 */
class ArticleServiceTest extends WebTestCase
{
    /**
     * @group service
     * @group article
     * @return null
     */
    public function testExport()
    {
        $status = $this->getContainer()->get('app.article.service')->exportEntities();
        $this->assertTrue($status);

        return null;
    }

    /**
     * @group service
     * @group article
     * @return null
     */
    public function testImport()
    {
        $status = $this->getContainer()->get('app.article.service')->importEntities();
        $this->assertTrue($status);

        return null;
    }
}
