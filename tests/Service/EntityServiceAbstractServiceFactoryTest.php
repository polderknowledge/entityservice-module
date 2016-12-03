<?php
/**
 * Polder Knowledge / entityservice-module (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/entityservice-module for the canonical source repository
 * @copyright Copyright (c) 2016 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/entityservice-module/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\EntityServiceTest\Service;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use PolderKnowledge\EntityService\EntityService;
use PolderKnowledge\EntityService\Repository\EntityRepositoryInterface;
use PolderKnowledge\EntityService\Repository\Service\EntityRepositoryManager;
use PolderKnowledge\EntityService\Service\EntityServiceAbstractServiceFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class EntityServiceAbstractServiceFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers PolderKnowledge\EntityService\Service\EntityServiceAbstractServiceFactory::canCreate
     */
    public function testCanCreateWithInvalidClass()
    {
        // Arrange
        $factory = new EntityServiceAbstractServiceFactory();

        $container = $this->getMockForAbstractClass(ContainerInterface::class);

        // Act
        $result = $factory->canCreate($container, '');

        // Assert
        $this->assertFalse($result);
    }

    /**
     * @covers PolderKnowledge\EntityService\Service\EntityServiceAbstractServiceFactory::canCreate
     */
    public function testCanCreateWithValidClass()
    {
        // Arrange
        $factory = new EntityServiceAbstractServiceFactory();

        $container = $this->getMockForAbstractClass(ContainerInterface::class);

        // Act
        $result = $factory->canCreate($container, 'stdClass');

        // Assert
        $this->assertTrue($result);
    }

    /**
     * @covers PolderKnowledge\EntityService\Service\EntityServiceAbstractServiceFactory::canCreateServiceWithName
     */
    public function testCanCreateServiceWithName()
    {
        // Arrange
        $factory = new EntityServiceAbstractServiceFactory();

        $serviceLocator = $this->getMockForAbstractClass(ServiceLocatorInterface::class);

        // Act
        $result = $factory->canCreateServiceWithName($serviceLocator, 'stdClass', 'stdClass');

        // Assert
        $this->assertTrue($result);
    }

    /**
     * @covers PolderKnowledge\EntityService\Service\EntityServiceAbstractServiceFactory::__invoke
     */
    public function testInvoke()
    {
        // Arrange
        $factory = new EntityServiceAbstractServiceFactory();

        $entityRepository = $this->getMockForAbstractClass(EntityRepositoryInterface::class);

        $entityRepositoryManagerBuilder = $this->getMockBuilder(EntityRepositoryManager::class);
        $entityRepositoryManagerBuilder->disableOriginalConstructor();
        $entityRepositoryManagerBuilder->setMethods(['get']);
        $entityRepositoryManager = $entityRepositoryManagerBuilder->getMockForAbstractClass();
        $entityRepositoryManager->method('get')->willReturn($entityRepository);

        $container = $this->getMockForAbstractClass(ContainerInterface::class);
        $container->method('get')->willReturn($entityRepositoryManager);

        // Act
        $result = $factory($container, 'stdClass', null);

        // Assert
        $this->assertInstanceOf(EntityService::class, $result);
    }

    /**
     * @covers PolderKnowledge\EntityService\Service\EntityServiceAbstractServiceFactory::createServiceWithName
     */
    public function testCreateServiceWithName()
    {
        // Arrange
        $factory = new EntityServiceAbstractServiceFactory();

        $entityRepository = $this->getMockForAbstractClass(EntityRepositoryInterface::class);

        $entityRepositoryManagerBuilder = $this->getMockBuilder(EntityRepositoryManager::class);
        $entityRepositoryManagerBuilder->disableOriginalConstructor();
        $entityRepositoryManagerBuilder->setMethods(['get']);
        $entityRepositoryManager = $entityRepositoryManagerBuilder->getMockForAbstractClass();
        $entityRepositoryManager->method('get')->willReturn($entityRepository);

        $serviceLocator = $this->getMockForAbstractClass(ServiceLocatorInterface::class);
        $serviceLocator->method('get')->willReturn($entityRepositoryManager);

        // Act
        $result = $factory->createServiceWithName($serviceLocator, 'stdClass', 'stdClass');

        // Assert
        $this->assertInstanceOf(EntityService::class, $result);
    }
}
