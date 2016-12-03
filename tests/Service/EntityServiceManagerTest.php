<?php
/**
 * Polder Knowledge / entityservice-module (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/entityservice-module for the canonical source repository
 * @copyright Copyright (c) 2016 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/entityservice-module/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\EntityServiceTest\Service;

use PHPUnit_Framework_TestCase;
use PolderKnowledge\EntityService\EntityServiceInterface;
use PolderKnowledge\EntityService\Service\EntityServiceManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class EntityServiceManagerV2Test extends PHPUnit_Framework_TestCase
{
    /**
     * @covers PolderKnowledge\EntityService\Service\EntityServiceManager::__construct
     */
    public function testConstruct()
    {
        // Arrange
        $serviceLocator = $this->getMockForAbstractClass(ServiceLocatorInterface::class);

        // Act
        $factory = new EntityServiceManager($serviceLocator, []);

        // Assert
        $reflection = new \ReflectionClass($factory);
        $property = $reflection->getProperty('abstractFactories');
        $property->setAccessible('public');
        $value = $property->getValue($factory);

        $this->assertCount(1, $value);
    }

    /**
     * @covers PolderKnowledge\EntityService\Service\EntityServiceManager::validate
     */
    public function testValidate()
    {
        // Arrange
        $serviceLocator = $this->getMockForAbstractClass(ServiceLocatorInterface::class);

        $entityService = $this->getMockForAbstractClass(EntityServiceInterface::class);

        $factory = new EntityServiceManager($serviceLocator, []);

        // Act
        $factory->validate($entityService);

        // Assert
        // No exception should be thrown so the test automatically succeeds.
    }

    /**
     * @covers PolderKnowledge\EntityService\Service\EntityServiceManager::validate
     * @expectedException Zend\ServiceManager\Exception\InvalidServiceException
     */
    public function testValidateWithoutEntityService()
    {
        // Arrange
        $serviceLocator = $this->getMockForAbstractClass(ServiceLocatorInterface::class);

        $factory = new EntityServiceManager($serviceLocator, []);

        // Act
        $factory->validate('');

        // Assert
        // No exception should be thrown so the test automatically succeeds.
    }
}
