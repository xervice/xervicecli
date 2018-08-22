<?php


namespace Xervice\XerviceCli\Business\Model\Generator;


use Symfony\Component\Console\Output\Output;
use Xervice\XerviceCli\Business\Model\Twig\Renderer;

class ServiceGenerator extends AbstractGenerator
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
            "{$this->name}/{$this->name}Config.php"                             => 'Service/ServiceConfig.twig',
            "{$this->name}/{$this->name}DependencyProvider.php"                 => 'Service/ServiceDependencyProvider.twig',
            "{$this->name}/Business/{$this->name}Facade.php"                    => 'Service/Business/ServiceFacade.twig',
            "{$this->name}/Business/{$this->name}BusinessFactory.php"           => 'Service/Business/ServiceBusinessFactory.twig',
            "{$this->name}/Communication/{$this->name}CommunicationFactory.php" => 'Service/Communication/ServiceCommunicationFactory.twig',
            "{$this->name}/Persistence/{$this->name}DataReader.php"             => 'Service/Persistence/ServiceDataReader.twig',
            "{$this->name}/Persistence/{$this->name}DataWriter.php"             => 'Service/Persistence/ServiceDataWriter.twig'
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