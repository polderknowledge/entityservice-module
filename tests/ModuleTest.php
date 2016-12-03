<?php
/**
 * Polder Knowledge / entityservice-module (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/entityservice-module for the canonical source repository
 * @copyright Copyright (c) 2016 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/entityservice-module/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\EntityServiceTest;

use PHPUnit_Framework_TestCase;
use PolderKnowledge\EntityService\ConfigProvider;
use PolderKnowledge\EntityService\Module;
use Zend\ModuleManager\Listener\ServiceListener;
use Zend\ModuleManager\ModuleManager;
use Zend\ServiceManager\ServiceManager;

class ModuleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers PolderKnowledge\EntityService\Module::getConfig
     */
    public function testGetConfig()
    {
        // Arrange
        $module = new Module();

        // Act
        $result = $module->getConfig();

        // Assert
        $this->assertInternalType('array', $result);
    }

    /**
     * @covers PolderKnowledge\EntityService\Module::init
     */
    public function testInit()
    {
        // Arrange
        $module = new Module();

        $serviceListenerBuilder = $this->getMockBuilder(ServiceListener::class);
        $serviceListenerBuilder->setMethods(['addServiceManager']);
        $serviceListenerBuilder->disableOriginalConstructor();

        $serviceListener = $serviceListenerBuilder->getMockForAbstractClass();
        $serviceListener->expects($this->exactly(2))->method('addServiceManager');

        $container = new ServiceManager();
        $container->setService('ServiceListener', $serviceListener);

        $moduleManager = new ModuleManager([]);
        $moduleManager->getEvent()->setParam('ServiceManager', $container);

        // Act
        $result = $module->init($moduleManager);

        // Assert
        $this->assertNull($result);
    }
}
