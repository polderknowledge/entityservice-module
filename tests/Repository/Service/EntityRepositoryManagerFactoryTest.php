<?php
/**
 * Polder Knowledge / entityservice-module (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/entityservice-module for the canonical source repository
 * @copyright Copyright (c) 2016 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/entityservice-module/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\EntityServiceTest\Repository\Service;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use PolderKnowledge\EntityService\Repository\Service\EntityRepositoryManager;
use PolderKnowledge\EntityService\Repository\Service\EntityRepositoryManagerFactory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EntityRepositoryManagerFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers PolderKnowledge\EntityService\Repository\Service\EntityRepositoryManagerFactory::__invoke
     */
    public function testInvoke()
    {
        // Arrange
        $factory = new EntityRepositoryManagerFactory();

        $container = $this->getMockForAbstractClass(ContainerInterface::class);

        // Act
        $result = $factory($container, null, null);

        // Assert
        $this->assertInstanceOf(EntityRepositoryManager::class, $result);
    }

    /**
     * @covers PolderKnowledge\EntityService\Repository\Service\EntityRepositoryManagerFactory::createService
     */
    public function testCreateService()
    {
        // Arrange
        $factory = new EntityRepositoryManagerFactory();

        $serviceLocator = $this->getMockForAbstractClass(ServiceLocatorInterface::class);

        // Act
        $result = $factory->createService($serviceLocator);

        // Assert
        $this->assertInstanceOf(EntityRepositoryManager::class, $result);
    }
}
