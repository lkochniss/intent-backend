<?php
/**
 * @package Test\AppBundle\Command
 */

namespace Test\AppBundle\Command;

use AppBundle\Command\ImportDatabaseCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

/**
 * Class ImportDatabaseCommandTest
 */
class ImportDatabaseCommandTest extends ExportDatabaseCommandTest
{
    /**
     * @var Command
     */
    public $command;

    /**
     * @group command
     * @return null
     */
    public function setUp()
    {
        $kernel = $this->createKernel();
        $kernel->boot();

        $application = new Application($kernel);
        $application->add(new ImportDatabaseCommand());

        $this->command = $application->find('intent:database:import');

        return null;
    }
}
