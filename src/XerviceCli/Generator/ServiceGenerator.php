<?php


namespace Xervice\XerviceCli\Generator;


use Symfony\Component\Console\Output\Output;
use Xervice\XerviceCli\Twig\Renderer;
use Xervice\XerviceCli\Generator\Exception\DirectoryNotWriteable;
use Xervice\XerviceCli\Generator\Exception\FileAlreadyExist;

class ServiceGenerator
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var Renderer
     */
    private $renderer;

    /**
     * @var \Symfony\Component\Console\Output\Output
     */
    private $messenger;

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
        $this->name = $name;
        $this->namespace = $namespace;
        $this->renderer = $renderer;
        $this->messenger = $messenger;
    }


    public function generateService()
    {
        $this->createFiles(
            $this->getTemplates(),
            $this->getVariables()
        );
    }

    /**
     * @return array
     */
    private function getTemplates(): array
    {
        $templates = [
            "{$this->name}/composer.json"                                                            => 'composer.twig',
            "{$this->name}/codeception.yml"                                                          => 'codeception.twig',
            "{$this->name}/.gitignore"                                                               => 'gitignore.twig',
            "{$this->name}/src/{$this->namespace}/{$this->name}/{$this->name}Client.php"             => 'Service/ServiceClient.twig',
            "{$this->name}/src/{$this->namespace}/{$this->name}/{$this->name}Config.php"             => 'Service/ServiceConfig.twig',
            "{$this->name}/src/{$this->namespace}/{$this->name}/{$this->name}DependencyProvider.php" => 'Service/ServiceDependencyProvider.twig',
            "{$this->name}/src/{$this->namespace}/{$this->name}/{$this->name}Facade.php"             => 'Service/ServiceFacade.twig',
            "{$this->name}/src/{$this->namespace}/{$this->name}/{$this->name}Factory.php"            => 'Service/ServiceFactory.twig',
        ];
        return $templates;
    }

    /**
     * @return array
     */
    private function getVariables(): array
    {
        $variables = [
            'name'      => $this->name,
            'namespace' => $this->namespace
        ];
        return $variables;
    }

    /**
     * @param $templates
     * @param $variables
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    private function createFiles($templates, $variables): void
    {
        foreach ($templates as $target => $template) {
            $path = getcwd() . '/' . dirname($target);

            $this->mkdir_r($path, 0755);

            try {
                $this->writeFileIfNotExist(
                    $target,
                    $this->renderer->renderTemplate($template, $variables)
                );

                $this->writeToMessenger('[GENERATED] ' . $target);
            } catch (FileAlreadyExist $e) {
                $this->writeToMessenger('[ERROR]: ' . $e->getMessage());
            }
        }
    }

    /**
     * @param string $message
     */
    private function writeToMessenger(string $message)
    {
        if ($this->messenger && $this->messenger->isVerbose()) {
            $this->messenger->writeln($message);
        }
    }


    /**
     * @param string $file
     * @param string $content
     */
    private function writeFileIfNotExist(string $file, string $content)
    {
        if (is_file($file)) {
            throw new FileAlreadyExist($file);
        }

        file_put_contents($file, $content);
    }

    /**
     * @param $dirName
     * @param int $rights
     *
     * @throws \XerviceCli\Generator\Exception\DirectoryNotWriteable
     */
    private function mkdir_r($dirName, $rights = 0777)
    {
        $dirs = explode('/', $dirName);
        $dir = '';
        foreach ($dirs as $part) {
            $dir .= $part . '/';
            if (!is_dir($dir) && strlen($dir) > 0) {
                if (!mkdir($dir, $rights) && !is_dir($dir)) {
                    throw new DirectoryNotWriteable($dir);
                }
            }
        }
    }
}