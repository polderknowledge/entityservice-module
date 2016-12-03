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

class ConfigProviderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers PolderKnowledge\EntityService\ConfigProvider::__invoke
     */
    public function testInvoke()
    {
        // Arrange
        $configProvider = new ConfigProvider();

        // Act
        $result = $configProvider();

        // Assert
        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('dependencies', $result);
        $this->assertArrayHasKey('validators', $result);
    }

    /**
     * @covers PolderKnowledge\EntityService\ConfigProvider::getDependencyConfig
     */
    public function testGetDependencyConfig()
    {
        // Arrange
        $configProvider = new ConfigProvider();

        // Act
        $result = $configProvider->getDependencyConfig();

        // Assert
        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('aliases', $result);
        $this->assertArrayHasKey('factories', $result);
    }

    /**
     * @covers PolderKnowledge\EntityService\ConfigProvider::getValidatorConfig
     */
    public function testGetValidatorConfig()
    {
        // Arrange
        $configProvider = new ConfigProvider();

        // Act
        $result = $configProvider->getValidatorConfig();

        // Assert
        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('factories', $result);
    }
}
