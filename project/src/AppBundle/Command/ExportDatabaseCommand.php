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
 * Class ExportDataCommand
 */
class ExportDatabaseCommand extends ContainerAwareCommand
{
    /**
     * @return null
     */
    protected function configure()
    {
        $this->setName('intent:database:export');
        $this->setDescription('Export database to XML');
        $this->addOption('all', '-l', InputOption::VALUE_NONE, 'Export all entities.');
        $this->addOption('art', '', InputOption::VALUE_NONE, 'Export entity article. Mind the dependencies.');
        $this->addOption('cat', '', InputOption::VALUE_NONE, 'Export entity category.');
        $this->addOption('dir', '', InputOption::VALUE_NONE, 'Export entity directory.');
        $this->addOption('evt', '', InputOption::VALUE_NONE, 'Export entity event.');
        $this->addOption('exp', '', InputOption::VALUE_NONE, 'Export entity expansion.');
        $this->addOption('fra', '', InputOption::VALUE_NONE, 'Export entity franchise. Mind the dependencies.');
        $this->addOption('gam', '', InputOption::VALUE_NONE, 'Export entity game. Mind the dependencies.');
        $this->addOption('img', '', InputOption::VALUE_NONE, 'Export entity image. Mind the dependencies.');
        $this->addOption('pag', '', InputOption::VALUE_NONE, 'Export entity page.');
        $this->addOption('pro', '', InputOption::VALUE_NONE, 'Export entity profile. Mind the dependencies');
        $this->addOption('pub', '', InputOption::VALUE_NONE, 'Export entity publisher.');
        $this->addOption('rol', '', InputOption::VALUE_NONE, 'Export entity role.');
        $this->addOption('stu', '', InputOption::VALUE_NONE, 'Export entity studio.');
        $this->addOption('tag', '', InputOption::VALUE_NONE, 'Export entity tag.');
        $this->addOption('usr', '', InputOption::VALUE_NONE, 'Export entity user. Mind the dependecies.');

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
            $this->getContainer()->get('app.article.service')->exportEntity();
            $output->writeln('exported article entity');
        }

        if ($input->getOption('all') || $input->getOption('cat')) {
            $this->getContainer()->get('app.category.service')->exportEntity();
            $output->writeln('exported category entity');
        }

        if ($input->getOption('all') || $input->getOption('dir')) {
            $this->getContainer()->get('app.directory.service')->exportEntity();
            $output->writeln('exported directory entity');
        }

        if ($input->getOption('all') || $input->getOption('evt')) {
            $this->getContainer()->get('app.event.service')->exportEntity();
            $output->writeln('exported event entity');
        }

        if ($input->getOption('all') || $input->getOption('exp')) {
            $this->getContainer()->get('app.expansion.service')->exportEntity();
            $output->writeln('exported expansion entity');
        }

        if ($input->getOption('all') || $input->getOption('fra')) {
            $this->getContainer()->get('app.franchise.service')->exportEntity();
            $output->writeln('exported franchise entity');
        }

        if ($input->getOption('all') || $input->getOption('gam')) {
            $this->getContainer()->get('app.game.service')->exportEntity();
            $output->writeln('exported game entity');
        }

        if ($input->getOption('all') || $input->getOption('img')) {
            $this->getContainer()->get('app.image.service')->exportEntity();
            $output->writeln('exported image entity');
        }

        if ($input->getOption('all') || $input->getOption('pag')) {
            $this->getContainer()->get('app.page.service')->exportEntity();
            $output->writeln('exported page entity');
        }

        if ($input->getOption('all') || $input->getOption('pro')) {
            $this->getContainer()->get('app.profile.service')->exportEntity();
            $output->writeln('exported profile entity');
        }

        if ($input->getOption('all') || $input->getOption('pub')) {
            $this->getContainer()->get('app.publisher.service')->exportEntity();
            $output->writeln('exported publisher entity');
        }

        if ($input->getOption('all') || $input->getOption('rol')) {
            $this->getContainer()->get('app.role.service')->exportEntity();
            $output->writeln('exported role entity');
        }

        if ($input->getOption('all') || $input->getOption('stu')) {
            $this->getContainer()->get('app.studio.service')->exportEntity();
            $output->writeln('exported studio entity');
        }

        if ($input->getOption('all') || $input->getOption('tag')) {
            $this->getContainer()->get('app.tag.service')->exportEntity();
            $output->writeln('exported tag entity');
        }

        if ($input->getOption('all') || $input->getOption('usr')) {
            $this->getContainer()->get('app.user.service')->exportEntity();
            $output->writeln('exported user entity');
        }

        return true;
    }
}
