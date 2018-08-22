<?php

namespace XerviceTest\XerviceCli\Generator;

use Xervice\Core\Business\Model\Locator\Dynamic\Business\DynamicBusinessLocator;

/**
 * @method \Xervice\XerviceCli\Business\XerviceCliFacade getFacade()
 */
class IntegrationTest extends \Codeception\Test\Unit
{
    use DynamicBusinessLocator;

    protected function _after(): void
    {
        $this->rrmdir(getcwd() . '/UnitTest');
    }


    /**
     * @group Xervice
     * @group XerviceCli
     * @group Generator
     * @group ProjectGenerator
     * @group Integration
     */
    public function testProjectGenerator()
    {
        $this->getFacade()->createNewProject('UnitTest', 'TestNamespace');
        $this->assertDirectoryExists(getcwd() . '/UnitTest');
        $this->assertFileExists(getcwd() . '/UnitTest/.scrutinizer.yml');
        $this->assertFileExists(getcwd() . '/UnitTest/.travis.yml');
        $this->assertFileExists(getcwd() . '/UnitTest/README.md');
        $this->assertFileExists(getcwd() . '/UnitTest/config/config_default.php');
        $this->assertFileExists(getcwd() . '/UnitTest/src/TestNamespace/UnitTest/Persistence/UnitTestDataReader.php');
        $this->assertFileExists(getcwd() . '/UnitTest/src/TestNamespace/UnitTest/Persistence/UnitTestDataWriter.php');
        $this->assertFileExists(getcwd() . '/UnitTest/src/TestNamespace/UnitTest/Communication/UnitTestCommunicationFactory.php');
        $this->assertFileExists(getcwd() . '/UnitTest/src/TestNamespace/UnitTest/Business/UnitTestBusinessFactory.php');
        $this->assertFileExists(getcwd() . '/UnitTest/src/TestNamespace/UnitTest/Business/UnitTestFacade.php');
        $this->assertFileExists(getcwd() . '/UnitTest/src/TestNamespace/UnitTest/UnitTestConfig.php');
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
        $this->getFacade()->createNewService('Unit-Test', 'TestNamespace');
        $this->assertDirectoryExists(getcwd() . '/UnitTest');
        $this->assertFileExists(getcwd() . '/UnitTest/UnitTestConfig.php');
        $this->assertFileExists(getcwd() . '/UnitTest/Communication/UnitTestCommunicationFactory.php');
    }

    /**
     * @param $dir
     */
    private function rrmdir($dir)
    {
        if (\is_dir($dir)) {
            $objects = \scandir($dir, SCANDIR_SORT_ASCENDING);
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