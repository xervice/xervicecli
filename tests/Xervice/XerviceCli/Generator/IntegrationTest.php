<?php

namespace XerviceTest\XerviceCli\Generator;

use Xervice\Core\Locator\Dynamic\DynamicLocator;

class IntegrationTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @var \XerviceTest\XerviceTester
     */
    protected $tester;

    protected function _after(): void
    {
        $this->rrmdir(getcwd() . '/UnitTest');
    }


    /**
     * @group Xervice
     * @group XerviceCli
     * @group Generator
     * @group ServiceGenerator
     * @group Integration
     */
    public function testServiceGenerator()
    {
        $this->getFacade()->createNewProject('UnitTest', 'TestNamespace');
        $this->assertTrue(is_dir(getcwd() . '/UnitTest'));
        $this->assertTrue(is_file(getcwd() . '/UnitTest/.scrutinizer.yml'));
        $this->assertTrue(is_file(getcwd() . '/UnitTest/config/config_default.php'));

        $this->rrmdir(getcwd() . '/UnitTest');

        $this->getFacade()->createNewService('UnitTest', 'TestNamespace');
        $this->assertTrue(is_dir(getcwd() . '/UnitTest'));
    }

    /**
     * @param $dir
     */
    private function rrmdir($dir)
    {
        if (\is_dir($dir)) {
            $objects = \scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (\is_dir($dir . "/" . $object)) {
                        $this->rrmdir($dir . "/" . $object);
                    }
                    else {
                        \unlink($dir . "/" . $object);
                    }
                }
            }
            \rmdir($dir);
        }
    }
}