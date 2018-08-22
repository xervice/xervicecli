<?php


namespace Xervice\XerviceCli\Communication\Console\Command;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Xervice\Console\Business\Model\Command\AbstractCommand;

/**
 * @method \Xervice\XerviceCli\Business\XerviceCliFacade getFacade()
 */
class XerviceCreateProjectCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('xervice:create:project')
            ->setDescription('Create new basic Xervice project with one example service structure')
            ->addArgument('name', InputArgument::REQUIRED, 'Your new project name')
            ->addArgument('namespace', InputArgument::OPTIONAL, 'Namespace of your service', 'App')
        ;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $namespace = $input->getArgument('namespace');

        $this->getFacade()->createNewProject($name, $namespace, $output);
    }
}