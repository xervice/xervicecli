<?php


namespace Xervice\XerviceCli\Business;


use Symfony\Component\Console\Output\Output;
use Xervice\Core\Business\Model\Factory\AbstractBusinessFactory;
use Xervice\XerviceCli\Business\Model\Generator\ProjectGenerator;
use Xervice\XerviceCli\Business\Model\Generator\ServiceGenerator;
use Xervice\XerviceCli\Business\Model\Twig\Renderer;

/**
 * @method \Xervice\XerviceCli\Business\XerviceCliConfig getConfig()
 */
class XerviceCliBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @param string $name
     * @param string $namespace
     * @param \Symfony\Component\Console\Output\Output $messenger
     *
     * @return \Xervice\XerviceCli\Business\Model\Generator\ServiceGenerator
     */
    public function getServicGenerator(string $name, string $namespace, Output $messenger = null): ServiceGenerator
    {
        return new ServiceGenerator(
            $name,
            $namespace,
            $this->createTwigRenderer(),
            $messenger
        );
    }

    /**
     * @param string $name
     * @param string $namespace
     * @param \Symfony\Component\Console\Output\Output|null $messenger
     *
     * @return \Xervice\XerviceCli\Business\Model\Generator\ProjectGenerator
     */
    public function getProjectGenerator(string $name, string $namespace, Output $messenger = null): ProjectGenerator
    {
        return new ProjectGenerator(
            $name,
            $namespace,
            $this->createTwigRenderer(),
            $messenger
        );
    }

    /**
     * @return \Xervice\XerviceCli\Business\Model\Twig\Renderer
     */
    public function createTwigRenderer(): Renderer
    {
        return new Renderer(
            $this->createTwig()
        );
    }

    /**
     * @return \Twig_Environment
     */
    public function createTwig()
    {
        return new \Twig_Environment(
            $this->createTwigLoader(),
            $this->getConfig()->getTwigConfig()
        );
    }

    /**
     * @return \Twig_Loader_Filesystem
     */
    public function createTwigLoader()
    {
        return new \Twig_Loader_Filesystem(
            $this->getConfig()->getTemplatePath()
        );
    }
}