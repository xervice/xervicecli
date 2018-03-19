<?php


namespace Xervice\XerviceCli;


use Symfony\Component\Console\Output\Output;
use Xervice\Core\Factory\AbstractFactory;
use Xervice\XerviceCli\Generator\ServiceGenerator;
use Xervice\XerviceCli\Twig\Renderer;

/**
 * @method \Xervice\XerviceCli\XerviceCliConfig getConfig()
 */
class XerviceCliFactory extends AbstractFactory
{
    /**
     * @param string $name
     * @param string $namespace
     * @param \Symfony\Component\Console\Output\Output $messenger
     *
     * @return \Xervice\XerviceCli\Generator\ServiceGenerator
     */
    public function getServicGenerator(string $name, string $namespace, Output $messenger = null)
    {
        return new ServiceGenerator(
            $name,
            $namespace,
            $this->createTwigRenderer(),
            $messenger
        );
    }

    /**
     * @return \Xervice\XerviceCli\Twig\Renderer
     */
    public function createTwigRenderer()
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