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
use PolderKnowledge\EntityService\Service\EntityServiceManagerFactory;
use PolderKnowledge\EntityService\Service\EntityServiceManagerV2;
use PolderKnowledge\EntityService\Service\EntityServiceManagerV3;
use Zend\ServiceManager\ServiceLocatorInterface;

class EntityServiceManagerFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers PolderKnowledge\EntityService\Service\EntityServiceManagerFactory::__invoke
     */
    public function testInvoke()
    {
        // Arrange
        $factory = new EntityServiceManagerFactory();

        $container = $this->getMockForAbstractClass(ContainerInterface::class);

        // Act
        $result = $factory($container, 'stdClass', null);

        // Assert
        $this->assertInstanceOf(EntityServiceManagerV3::class, $result);
    }

    /**
     * @covers PolderKnowledge\EntityService\Service\EntityServiceManagerFactory::__invoke
     * @covers PolderKnowledge\EntityService\Service\EntityServiceManagerFactory::createService
     */
    public function testCreateService()
    {
        // Arrange
        $factory = new EntityServiceManagerFactory();

        $serviceLocator = $this->getMockForAbstractClass(ServiceLocatorInterface::class);

        // Act
        $result = $factory->createService($serviceLocator);

        // Assert
        $this->assertInstanceOf(EntityServiceManagerV2::class, $result);
    }
}
