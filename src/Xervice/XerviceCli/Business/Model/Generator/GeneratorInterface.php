<?php

namespace Xervice\XerviceCli\Business\Model\Generator;

interface GeneratorInterface
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function generateService();
}