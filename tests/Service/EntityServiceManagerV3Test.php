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
use PolderKnowledge\EntityService\Service\EntityServiceManagerV3;
use Zend\ServiceManager\ServiceLocatorInterface;

class EntityServiceManagerV3Test extends PHPUnit_Framework_TestCase
{
    /**
     * @covers PolderKnowledge\EntityService\Service\EntityServiceManagerV3::__construct
     */
    public function testConstruct()
    {
        // Arrange
        $serviceLocator = $this->getMockForAbstractClass(ServiceLocatorInterface::class);

        // Act
        $factory = new EntityServiceManagerV3($serviceLocator, []);

        // Assert
        $reflection = new \ReflectionClass($factory);
        $property = $reflection->getProperty('abstractFactories');
        $property->setAccessible('public');
        $value = $property->getValue($factory);

        $this->assertCount(1, $value);
    }
}
