<?php


namespace Xervice\XerviceCli\Business\Model\Generator;


use Symfony\Component\Console\Output\Output;
use Xervice\XerviceCli\Business\Model\Generator\Exception\DirectoryNotWriteable;
use Xervice\XerviceCli\Business\Model\Generator\Exception\FileAlreadyExist;
use Xervice\XerviceCli\Business\Model\Twig\Renderer;

abstract class AbstractGenerator implements GeneratorInterface
{
    /**
     * @var Renderer
     */
    protected $renderer;

    /**
     * @var \Symfony\Component\Console\Output\Output
     */
    protected $messenger;

    /**
     * AbstractGenerator constructor.
     *
     * @param Renderer $renderer
     * @param \Symfony\Component\Console\Output\Output $messenger
     */
    public function __construct(
        Renderer $renderer,
        Output $messenger = null
    ) {
        $this->renderer = $renderer;
        $this->messenger = $messenger;
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
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
    protected function getTemplates(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function getVariables(): array
    {
        return [];
    }

    /**
     * @param $templates
     * @param $variables
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    protected function createFiles($templates, $variables): void
    {
        foreach ($templates as $target => $template) {
            $path = \getcwd() . '/' . \dirname($target);

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
     * @param $dirName
     * @param int $rights
     *
     * @throws \XerviceCli\Generator\Exception\DirectoryNotWriteable
     */
    protected function mkdir_r($dirName, $rights = 0777)
    {
        $dirs = explode('/', $dirName);
        $dir = '';
        foreach ($dirs as $part) {
            $dir .= $part . '/';
            if (!\is_dir($dir) && strlen($dir) > 0) {
                if (!mkdir($dir, $rights) && !\is_dir($dir)) {
                    throw new DirectoryNotWriteable($dir);
                }
            }
        }
    }

    /**
     * @param string $message
     */
    protected function writeToMessenger(string $message)
    {
        if ($this->messenger && $this->messenger->isVerbose()) {
            $this->messenger->writeln($message);
        }
    }

    /**
     * @param string $file
     * @param string $content
     *
     * @throws \Xervice\XerviceCli\Business\Model\Generator\Exception\FileAlreadyExist
     */
    protected function writeFileIfNotExist(string $file, string $content)
    {
        if (is_file($file)) {
            throw new FileAlreadyExist($file);
        }

        file_put_contents($file, $content);
    }
}