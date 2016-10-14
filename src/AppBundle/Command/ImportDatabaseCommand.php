<?php
/**
 * @package AppBundle\Command
 */

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportDatabaseCommand
 */
class ImportDatabaseCommand extends ContainerAwareCommand
{
    /**
     * @return null
     */
    protected function configure()
    {
        $this->setName('intent:database:import');
        $this->setDescription('Import database from XML source');
        $this->addOption('all', '-l', InputOption::VALUE_NONE, 'Import all entities.');
        $this->addOption('art', '', InputOption::VALUE_NONE, 'Import entity article. Mind the dependencies.');
        $this->addOption('cat', '', InputOption::VALUE_NONE, 'Import entity category.');
        $this->addOption('dir', '', InputOption::VALUE_NONE, 'Import entity directory.');
        $this->addOption('evt', '', InputOption::VALUE_NONE, 'Import entity event.');
        $this->addOption('exp', '', InputOption::VALUE_NONE, 'Import entity expansion.');
        $this->addOption('fra', '', InputOption::VALUE_NONE, 'Import entity franchise. Mind the dependencies.');
        $this->addOption('gam', '', InputOption::VALUE_NONE, 'Import entity game. Mind the dependencies.');
        $this->addOption('img', '', InputOption::VALUE_NONE, 'Import entity image. Mind the dependencies.');
        $this->addOption('pag', '', InputOption::VALUE_NONE, 'Import entity page.');
        $this->addOption('pro', '', InputOption::VALUE_NONE, 'Import entity profile. Mind the dependencies');
        $this->addOption('pub', '', InputOption::VALUE_NONE, 'Import entity publisher.');
        $this->addOption('rol', '', InputOption::VALUE_NONE, 'Import entity role.');
        $this->addOption('stu', '', InputOption::VALUE_NONE, 'Import entity studio.');
        $this->addOption('tag', '', InputOption::VALUE_NONE, 'Import entity tag.');
        $this->addOption('usr', '', InputOption::VALUE_NONE, 'Import entity user. Mind the dependecies.');

        return null;
    }

    /**
     * @param InputInterface  $input  Input of command.
     * @param OutputInterface $output Output of command.
     * @return boolean
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('all') || $input->getOption('art')) {
            $this->getContainer()->get('app.article.service')->importEntities();
            $output->writeln('exported article entity');
        }

        if ($input->getOption('all') || $input->getOption('cat')) {
            $this->getContainer()->get('app.category.service')->importEntities();
            $output->writeln('exported category entity');
        }

        if ($input->getOption('all') || $input->getOption('dir')) {
            $this->getContainer()->get('app.directory.service')->importEntities();
            $output->writeln('exported directory entity');
        }

        if ($input->getOption('all') || $input->getOption('evt')) {
            $this->getContainer()->get('app.event.service')->importEntities();
            $output->writeln('exported event entity');
        }

        if ($input->getOption('all') || $input->getOption('exp')) {
            $this->getContainer()->get('app.expansion.service')->importEntities();
            $output->writeln('exported expansion entity');
        }

        if ($input->getOption('all') || $input->getOption('fra')) {
            $this->getContainer()->get('app.franchise.service')->importEntities();
            $output->writeln('exported franchise entity');
        }

        if ($input->getOption('all') || $input->getOption('gam')) {
            $this->getContainer()->get('app.game.service')->importEntities();
            $output->writeln('exported game entity');
        }

        if ($input->getOption('all') || $input->getOption('img')) {
            $this->getContainer()->get('app.image.service')->importEntities();
            $output->writeln('exported image entity');
        }

        if ($input->getOption('all') || $input->getOption('pag')) {
            $this->getContainer()->get('app.page.service')->importEntities();
            $output->writeln('exported page entity');
        }

        if ($input->getOption('all') || $input->getOption('pro')) {
            $this->getContainer()->get('app.profile.service')->importEntities();
            $output->writeln('exported profile entity');
        }

        if ($input->getOption('all') || $input->getOption('pub')) {
            $this->getContainer()->get('app.publisher.service')->importEntities();
            $output->writeln('exported publisher entity');
        }

        if ($input->getOption('all') || $input->getOption('rol')) {
            $this->getContainer()->get('app.role.service')->importEntities();
            $output->writeln('exported role entity');
        }

        if ($input->getOption('all') || $input->getOption('stu')) {
            $this->getContainer()->get('app.studio.service')->importEntities();
            $output->writeln('exported studio entity');
        }

        if ($input->getOption('all') || $input->getOption('tag')) {
            $this->getContainer()->get('app.tag.service')->importEntities();
            $output->writeln('exported tag entity');
        }

        if ($input->getOption('all') || $input->getOption('usr')) {
            $this->getContainer()->get('app.user.service')->importEntities();
            $output->writeln('exported user entity');
        }

        return true;
    }
}
