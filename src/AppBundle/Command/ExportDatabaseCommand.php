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
     * Add some command options to export data by entity type or all at once
     */
    protected function configure()
    {
        $this->setName('intent:database:export');
        $this->setDescription('Export database to XML');
        $this->addOption('all', '-l', InputOption::VALUE_NONE, 'Export all entities.');
        $this->addOption('art', '', InputOption::VALUE_NONE, 'Export article entities. Mind the dependencies.');
        $this->addOption('cat', '', InputOption::VALUE_NONE, 'Export category entities.');
        $this->addOption('dir', '', InputOption::VALUE_NONE, 'Export directory entities.');
        $this->addOption('evt', '', InputOption::VALUE_NONE, 'Export event entities.');
        $this->addOption('exp', '', InputOption::VALUE_NONE, 'Export expansion entities.');
        $this->addOption('fra', '', InputOption::VALUE_NONE, 'Export franchise entities. Mind the dependencies.');
        $this->addOption('gam', '', InputOption::VALUE_NONE, 'Export game entities. Mind the dependencies.');
        $this->addOption('img', '', InputOption::VALUE_NONE, 'Export image entities. Mind the dependencies.');
        $this->addOption('pag', '', InputOption::VALUE_NONE, 'Export page entities.');
        $this->addOption('pro', '', InputOption::VALUE_NONE, 'Export profile entities. Mind the dependencies');
        $this->addOption('pub', '', InputOption::VALUE_NONE, 'Export publisher entities.');
        $this->addOption('rol', '', InputOption::VALUE_NONE, 'Export role entities.');
        $this->addOption('stu', '', InputOption::VALUE_NONE, 'Export studio entities.');
        $this->addOption('tag', '', InputOption::VALUE_NONE, 'Export tag entities.');
        $this->addOption('usr', '', InputOption::VALUE_NONE, 'Export user entities. Mind the dependecies.');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return boolean
     */
    protected function execute(InputInterface $input, OutputInterface $output) : bool
    {
        if ($input->getOption('all') || $input->getOption('art')) {
            $this->getContainer()->get('app.article.service')->exportEntities();
            $output->writeln('exported article entities');
        }

        if ($input->getOption('all') || $input->getOption('cat')) {
            $this->getContainer()->get('app.category.service')->exportEntities();
            $output->writeln('exported category entities');
        }

        if ($input->getOption('all') || $input->getOption('dir')) {
            $this->getContainer()->get('app.directory.service')->exportEntities();
            $output->writeln('exported directory entities');
        }

        if ($input->getOption('all') || $input->getOption('evt')) {
            $this->getContainer()->get('app.event.service')->exportEntities();
            $output->writeln('exported event entities');
        }

        if ($input->getOption('all') || $input->getOption('exp')) {
            $this->getContainer()->get('app.expansion.service')->exportEntities();
            $output->writeln('exported expansion entities');
        }

        if ($input->getOption('all') || $input->getOption('fra')) {
            $this->getContainer()->get('app.franchise.service')->exportEntities();
            $output->writeln('exported franchise entities');
        }

        if ($input->getOption('all') || $input->getOption('gam')) {
            $this->getContainer()->get('app.game.service')->exportEntities();
            $output->writeln('exported game entities');
        }

        if ($input->getOption('all') || $input->getOption('img')) {
            $this->getContainer()->get('app.image.service')->exportEntities();
            $output->writeln('exported image entities');
        }

        if ($input->getOption('all') || $input->getOption('pag')) {
            $this->getContainer()->get('app.page.service')->exportEntities();
            $output->writeln('exported page entities');
        }

        if ($input->getOption('all') || $input->getOption('pro')) {
            $this->getContainer()->get('app.profile.service')->exportEntities();
            $output->writeln('exported profile entities');
        }

        if ($input->getOption('all') || $input->getOption('pub')) {
            $this->getContainer()->get('app.publisher.service')->exportEntities();
            $output->writeln('exported publisher entities');
        }

        if ($input->getOption('all') || $input->getOption('rol')) {
            $this->getContainer()->get('app.role.service')->exportEntities();
            $output->writeln('exported role entities');
        }

        if ($input->getOption('all') || $input->getOption('stu')) {
            $this->getContainer()->get('app.studio.service')->exportEntities();
            $output->writeln('exported studio entities');
        }

        if ($input->getOption('all') || $input->getOption('tag')) {
            $this->getContainer()->get('app.tag.service')->exportEntities();
            $output->writeln('exported tag entities');
        }

        if ($input->getOption('all') || $input->getOption('usr')) {
            $this->getContainer()->get('app.user.service')->exportEntities();
            $output->writeln('exported user entities');
        }

        return true;
    }
}
