<?php


namespace App\Console;


use Xervice\Console\ConsoleDependencyProvider as XerviceConsoleDependencyProvider;
use Xervice\DataProvider\Console\CleanCommand;
use Xervice\DataProvider\Console\GenerateCommand;
use Xervice\XerviceCli\Command\XerviceCreateProjectCommand;
use Xervice\XerviceCli\Command\XerviceCreateServiceCommand;

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