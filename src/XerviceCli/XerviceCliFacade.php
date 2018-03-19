<?php


namespace Xervice\XerviceCli;


use Symfony\Component\Console\Output\Output;
use Xervice\Core\Facade\AbstractFacade;

class XerviceCliFacade extends AbstractFacade
{
    /**
     * @param string $name
     * @param string $namespace
     * @param \Symfony\Component\Console\Output\Output $messenger
     */
    public function createNewService(string $name, string $namespace, Output $messenger = null)
    {
        $this->getFactory()->getServicGenerator($name, $namespace, $messenger)->generateService();
    }
}