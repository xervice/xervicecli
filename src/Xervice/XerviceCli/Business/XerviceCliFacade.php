<?php


namespace Xervice\XerviceCli\Business;


use Symfony\Component\Console\Output\Output;
use Xervice\Core\Business\Model\Facade\AbstractFacade;

/**
 * @method \Xervice\XerviceCli\Business\XerviceCliBusinessFactory getFactory()
 */
class XerviceCliFacade extends AbstractFacade
{
    /**
     * @param string $name
     * @param string $namespace
     * @param \Symfony\Component\Console\Output\Output|null $messenger
     */
    public function createNewService(string $name, string $namespace, Output $messenger = null)
    {
        $this->getFactory()->getServicGenerator($name, $namespace, $messenger)->generateService();
    }

    /**
     * @param string $name
     * @param string $namespace
     * @param \Symfony\Component\Console\Output\Output|null $messenger
     */
    public function createNewProject(string $name, string $namespace, Output $messenger = null)
    {
        $this->getFactory()->getProjectGenerator($name, $namespace, $messenger)->generateService();
    }
}