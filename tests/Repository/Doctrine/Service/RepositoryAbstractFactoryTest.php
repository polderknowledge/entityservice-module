<?php
/**
 * Polder Knowledge / entityservice (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/entityservice for the canonical source repository
 * @copyright Copyright (c) 2016 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/entityservice/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\EntityServiceTest\Repository\Doctrine\Service;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use PolderKnowledge\EntityService\Repository\Doctrine\ORMRepository;
use PolderKnowledge\EntityService\Repository\Doctrine\Service\RepositoryAbstractFactory;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;

class RepositoryAbstractFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers PolderKnowledge\EntityService\Repository\Doctrine\Service\RepositoryAbstractFactory::canCreate
     */
    public function testCanCreate()
    {
        // Arrange
        $factory = new RepositoryAbstractFactory();
        $mock = $this->getMockForAbstractClass(ServiceLocatorInterface::class);

        // Act
        $result = $factory->canCreate($mock, null, null);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * @covers PolderKnowledge\EntityService\Repository\Doctrine\Service\RepositoryAbstractFactory::__invoke
     */
    public function testInvoke()
    {
        // Arrange
        $factory = new RepositoryAbstractFactory();

        $entityManagerMockBuilder = $this->getMockBuilder(EntityManager::class);
        $entityManagerMockBuilder->disableOriginalConstructor();
        $entityManager = $entityManagerMockBuilder->getMock();

        $container = $this->getMockForAbstractClass(ContainerInterface::class);
        $container->expects($this->once())->method('get')->willReturn($entityManager);

        // Act
        $result = $factory->__invoke($container, null, null);

        // Assert
        $this->assertInstanceOf(ORMRepository::class, $result);
    }

    /**
     * @covers PolderKnowledge\EntityService\Repository\Doctrine\Service\RepositoryAbstractFactory::__invoke
     */
    public function testInvokeWithDoctrineOptions()
    {
        // Arrange
        $factory = new RepositoryAbstractFactory();

        $entityManagerMockBuilder = $this->getMockBuilder(EntityManager::class);
        $entityManagerMockBuilder->disableOriginalConstructor();
        $entityManager = $entityManagerMockBuilder->getMock();

        $container = $this->getMockForAbstractClass(ContainerInterface::class);
        $container->expects($this->once())->method('get')->willReturn($entityManager);

        // Act
        $result = $factory->__invoke($container, null, [
            'doctrine_entity_manager' => $entityManager,
        ]);

        // Assert
        $this->assertInstanceOf(ORMRepository::class, $result);
    }

    /**
     * @covers PolderKnowledge\EntityService\Repository\Doctrine\Service\RepositoryAbstractFactory::canCreateServiceWithName
     */
    public function testCanCreateServiceWithName()
    {
        // Arrange
        $factory = new RepositoryAbstractFactory();

        $container = $this->getMockForAbstractClass(ServiceLocatorInterface::class);

        // Act
        $result = $factory->canCreateServiceWithName($container, null, null);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * @covers PolderKnowledge\EntityService\Repository\Doctrine\Service\RepositoryAbstractFactory::createServiceWithName
     */
    public function testCreateServiceWithName()
    {
        // Arrange
        $factory = new RepositoryAbstractFactory();

        $entityManagerMockBuilder = $this->getMockBuilder(EntityManager::class);
        $entityManagerMockBuilder->disableOriginalConstructor();
        $entityManager = $entityManagerMockBuilder->getMock();

        $container = $this->getMockForAbstractClass(ServiceLocatorInterface::class);
        $container->expects($this->once())->method('get')->willReturn($entityManager);

        // Act
        $result = $factory->createServiceWithName($container, null, null);

        // Assert
        $this->assertNotNull($result);
    }
}
