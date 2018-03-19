<?php


namespace Xervice\XerviceCli;


use Xervice\Core\Config\AbstractConfig;

class XerviceCliConfig extends AbstractConfig
{
    /**
     * @return array
     */
    public function getTwigConfig()
    {
        return [
            'cache' => false
        ];
    }

    /**
     * @return string
     */
    public function getCachePath()
    {
        return __DIR__ . '/Cache';
    }

    /**
     * @return string
     */
    public function getTemplatePath()
    {
        return __DIR__ . '/Templates';
    }
}