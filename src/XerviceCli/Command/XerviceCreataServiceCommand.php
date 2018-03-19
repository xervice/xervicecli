<?php


namespace Xervice\XerviceCli\Command;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Xervice\Console\Command\AbstractCommand;

class XerviceCreataServiceCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('xervice:create:service')
            ->setDescription('Create new basic Xervice service')
            ->addArgument('name', InputArgument::REQUIRED, 'Your new service name')
            ->addArgument('namespace', InputArgument::OPTIONAL, 'Namespace of your service', 'Xervice');
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

        $this->getFacade()->createNewService($name, $namespace, $output);

    }


}