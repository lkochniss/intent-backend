<?php
/**
 * @package AppBundle\Test\Command
 */

namespace AppBundle\Test\Command;

use AppBundle\Command\ExportDatabaseCommand;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class ExportDatabaseCommandTest
 */
class ExportDatabaseCommandTest extends WebTestCase
{
    /**
     * @var Command
     */
    public $command;

    /**
     * @return null
     */
    public function setUp()
    {
        $kernel = $this->createKernel();
        $kernel->boot();

        $application = new Application($kernel);
        $application->add(new ExportDatabaseCommand());

        $this->command = $application->find('intent:database:export');

        return null;
    }

    /**
     * @return null
     */
    public function testAllParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --all'));
        $commandTester->execute(array('command' => $this->command->getName() . ' -l'));

        return null;
    }

    /**
     * @return null
     */
    public function testArtParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --art'));

        return null;
    }

    /**
     * @return null
     */
    public function testCatParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --cat'));

        return null;
    }

    /**
     * @return null
     */
    public function testDirParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --dir'));

        return null;
    }

    /**
     * @return null
     */
    public function testEvtParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --evt'));

        return null;
    }

    /**
     * @return null
     */
    public function testExpParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --exp'));

        return null;
    }

    /**
     * @return null
     */
    public function testFraParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --fra'));

        return null;
    }

    /**
     * @return null
     */
    public function testGamParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --gam'));

        return null;
    }

    /**
     * @return null
     */
    public function testImgParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --img'));

        return null;
    }

    /**
     * @return null
     */
    public function testPagParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --pag'));

        return null;
    }

    /**
     * @return null
     */
    public function testProParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --pro'));

        return null;
    }

    /**
     * @return null
     */
    public function testPubParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --pub'));

        return null;
    }

    /**
     * @return null
     */
    public function testRolParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --rol'));

        return null;
    }

    /**
     * @return null
     */
    public function testStuParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --stu'));

        return null;
    }

    /**
     * @return null
     */
    public function testTagParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --tag'));

        return null;
    }

    /**
     * @return null
     */
    public function testUsrParameter()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute(array('command' => $this->command->getName() . ' --usr'));

        return null;
    }
}
