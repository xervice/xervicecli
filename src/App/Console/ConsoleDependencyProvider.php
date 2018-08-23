<?php


namespace App\Console;


use Xervice\Console\ConsoleDependencyProvider as XerviceConsoleDependencyProvider;
use Xervice\DataProvider\Communication\Console\CleanCommand;
use Xervice\DataProvider\Communication\Console\GenerateCommand;
use Xervice\XerviceCli\Communication\Console\Command\XerviceCreateProjectCommand;
use Xervice\XerviceCli\Communication\Console\Command\XerviceCreateServiceCommand;

class ConsoleDependencyProvider extends XerviceConsoleDependencyProvider
{
    /**
     * @return array
     */
    protected function getCommandList(): array
    {
        return [
            new XerviceCreateServiceCommand(),
            new XerviceCreateProjectCommand(),
            new GenerateCommand(),
            new CleanCommand()
        ];
    }

}