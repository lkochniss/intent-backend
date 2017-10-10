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
     * Add some command options to import data by entity type or all at once
     */
    protected function configure()
    {
        $this->setName('intent:database:import');
        $this->setDescription('Import database from XML source');
        $this->addOption('all', '-l', InputOption::VALUE_NONE, 'Import all entities.');
        $this->addOption('art', '', InputOption::VALUE_NONE, 'Import article entities. Mind the dependencies.');
        $this->addOption('cat', '', InputOption::VALUE_NONE, 'Import category entities.');
        $this->addOption('dir', '', InputOption::VALUE_NONE, 'Import directory entities.');
        $this->addOption('evt', '', InputOption::VALUE_NONE, 'Import event entities.');
        $this->addOption('exp', '', InputOption::VALUE_NONE, 'Import expansion entities.');
        $this->addOption('fra', '', InputOption::VALUE_NONE, 'Import franchise entities. Mind the dependencies.');
        $this->addOption('gam', '', InputOption::VALUE_NONE, 'Import game entities. Mind the dependencies.');
        $this->addOption('img', '', InputOption::VALUE_NONE, 'Import image entities. Mind the dependencies.');
        $this->addOption('pag', '', InputOption::VALUE_NONE, 'Import page entities.');
        $this->addOption('pro', '', InputOption::VALUE_NONE, 'Import profile entities. Mind the dependencies');
        $this->addOption('pub', '', InputOption::VALUE_NONE, 'Import publisher.');
        $this->addOption('rol', '', InputOption::VALUE_NONE, 'Import role entities.');
        $this->addOption('stu', '', InputOption::VALUE_NONE, 'Import studio entities.');
        $this->addOption('tag', '', InputOption::VALUE_NONE, 'Import tag entities.');
        $this->addOption('usr', '', InputOption::VALUE_NONE, 'Import user entities. Mind the dependecies.');
    }

    /**
     * @param InputInterface  $input  Input of command.
     * @param OutputInterface $output Output of command.
     * @return boolean
     */
    protected function execute(InputInterface $input, OutputInterface $output) : bool
    {
        if ($input->getOption('all') || $input->getOption('art')) {
            $this->getContainer()->get('app.article.service')->importEntities();
            $output->writeln('imported article entities');
        }

        if ($input->getOption('all') || $input->getOption('cat')) {
            $this->getContainer()->get('app.category.service')->importEntities();
            $output->writeln('imported category entities');
        }

        if ($input->getOption('all') || $input->getOption('dir')) {
            $this->getContainer()->get('app.directory.service')->importEntities();
            $output->writeln('imported directory entities');
        }

        if ($input->getOption('all') || $input->getOption('evt')) {
            $this->getContainer()->get('app.event.service')->importEntities();
            $output->writeln('imported event entities');
        }

        if ($input->getOption('all') || $input->getOption('exp')) {
            $this->getContainer()->get('app.expansion.service')->importEntities();
            $output->writeln('imported expansion entities');
        }

        if ($input->getOption('all') || $input->getOption('fra')) {
            $this->getContainer()->get('app.franchise.service')->importEntities();
            $output->writeln('imported franchise entities');
        }

        if ($input->getOption('all') || $input->getOption('gam')) {
            $this->getContainer()->get('app.game.service')->importEntities();
            $output->writeln('imported game entities');
        }

        if ($input->getOption('all') || $input->getOption('img')) {
            $this->getContainer()->get('app.image.service')->importEntities();
            $output->writeln('imported image entities');
        }

        if ($input->getOption('all') || $input->getOption('pag')) {
            $this->getContainer()->get('app.page.service')->importEntities();
            $output->writeln('imported page entities');
        }

        if ($input->getOption('all') || $input->getOption('pro')) {
            $this->getContainer()->get('app.profile.service')->importEntities();
            $output->writeln('imported profile entities');
        }

        if ($input->getOption('all') || $input->getOption('pub')) {
            $this->getContainer()->get('app.publisher.service')->importEntities();
            $output->writeln('imported publisher entities');
        }

        if ($input->getOption('all') || $input->getOption('rol')) {
            $this->getContainer()->get('app.role.service')->importEntities();
            $output->writeln('imported role entities');
        }

        if ($input->getOption('all') || $input->getOption('stu')) {
            $this->getContainer()->get('app.studio.service')->importEntities();
            $output->writeln('imported studio entities');
        }

        if ($input->getOption('all') || $input->getOption('tag')) {
            $this->getContainer()->get('app.tag.service')->importEntities();
            $output->writeln('imported tag entities');
        }

        if ($input->getOption('all') || $input->getOption('usr')) {
            $this->getContainer()->get('app.user.service')->importEntities();
            $output->writeln('imported user entities');
        }

        return true;
    }
}
