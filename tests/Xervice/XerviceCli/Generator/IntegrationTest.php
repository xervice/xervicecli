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

    /**
     * @group Xervice
     * @group XerviceCli
     * @group Generator
     * @group ServiceGenerator
     * @group Integration
     */
    public function testServiceGenerator()
    {
        $this->getFacade()->createNewService('UnitTest', 'TestNamespace');
    }
}