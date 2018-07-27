<?php


namespace Xervice\XerviceCli\Generator;


use Symfony\Component\Console\Output\Output;
use Xervice\XerviceCli\Twig\Renderer;

class ProjectGenerator extends AbstractGenerator
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $origName;

    /**
     * @var string
     */
    private $namespace;

    /**
     * ServiceGenerator constructor.
     *
     * @param string $name
     * @param string $namespace
     * @param Renderer $renderer
     * @param \Symfony\Component\Console\Output\Output $messenger
     */
    public function __construct(
        string $name,
        string $namespace,
        Renderer $renderer,
        Output $messenger = null
    ) {
        $this->origName = $name;
        $this->name = str_replace('-', '', $name);
        $this->namespace = $namespace;

        parent::__construct($renderer, $messenger);
    }


    /**
     * @return array
     */
    protected function getTemplates(): array
    {
        return [
            "{$this->origName}/composer.json"                                                            => 'composer.twig',
            "{$this->origName}/codeception.yml"                                                          => 'codeception.twig',
            "{$this->origName}/.scrutinizer.yml"                                                         => '.scrutinizer.twig',
            "{$this->origName}/.travis.yml"                                                              => '.travis.twig',
            "{$this->origName}/.gitignore"                                                               => 'gitignore.twig',
            "{$this->origName}/README.md"                                                                => 'README.twig',
            "{$this->origName}/config/config_default.php"                                                => 'Config/config_default.twig',
            "{$this->origName}/tests/.gitkeep"                                                           => '.gitkeep',
            "{$this->origName}/src/Generated/.gitkeep"                                                   => '.gitkeep',
            "{$this->origName}/src/{$this->namespace}/{$this->name}/{$this->name}Client.php"             => 'Service/ServiceClient.twig',
            "{$this->origName}/src/{$this->namespace}/{$this->name}/{$this->name}Config.php"             => 'Service/ServiceConfig.twig',
            "{$this->origName}/src/{$this->namespace}/{$this->name}/{$this->name}DependencyProvider.php" => 'Service/ServiceDependencyProvider.twig',
            "{$this->origName}/src/{$this->namespace}/{$this->name}/{$this->name}Facade.php"             => 'Service/ServiceFacade.twig',
            "{$this->origName}/src/{$this->namespace}/{$this->name}/{$this->name}Factory.php"            => 'Service/ServiceFactory.twig',
        ];
    }

    /**
     * @return array
     */
    protected function getVariables(): array
    {
        return [
            'name'      => $this->name,
            'origname'  => $this->origName,
            'namespace' => $this->namespace
        ];
    }
}