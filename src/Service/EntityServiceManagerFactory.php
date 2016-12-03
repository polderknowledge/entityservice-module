<?php
/**
 * Polder Knowledge / entityservice-module (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/entityservice-module for the canonical source repository
 * @copyright Copyright (c) 2016 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/entityservice-module/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\EntityService\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EntityServiceManagerFactory implements FactoryInterface
{
    private $shouldCreateV2 = false;

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $options ?: [];

        if ($this->shouldCreateV2) {
            return new EntityServiceManagerV2($container, $options);
        }

        return new EntityServiceManagerV3($container, $options);
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->shouldCreateV2 = true;

        // @codeCoverageIgnoreStart
        if (method_exists($serviceLocator, 'getServiceLocator')) {
            $serviceLocator = $serviceLocator->getServiceLocator();
        }
        // @codeCoverageIgnoreEnd

        return $this($serviceLocator, '');
    }
}
