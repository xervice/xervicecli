<?php


namespace Xervice\XerviceCli\Twig;

class Renderer
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * Renderer constructor.
     *
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param string $template
     * @param array $variables
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function renderTemplate(string $template, array $variables = [])
    {
        $template = $this->twig->load($template);
        return $template->render($variables);
    }

}