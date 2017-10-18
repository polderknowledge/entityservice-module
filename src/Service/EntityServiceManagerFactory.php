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
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EntityServiceManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $options ?: [];

        $pluginManager = new EntityServiceManager($container, $options);

        // If this is in a zend-mvc application, the ServiceListener will inject
        // merged configuration during bootstrap.
        if ($container->has('ServiceListener')) {
            return $pluginManager;
        }

        // If we do not have a config service, nothing more to do
        if (! $container->has('config')) {
            return $pluginManager;
        }

        $config = $container->get('config');
        // If we do not have log_filters configuration, nothing more to do
        if (! isset($config['entity_service_manager']) || ! is_array($config['entity_service_manager'])) {
            return $pluginManager;
        }
        // Wire service configuration for log_filters
        (new Config($config['entity_service_manager']))->configureServiceManager($pluginManager);

        return $pluginManager;
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // @codeCoverageIgnoreStart
        if (method_exists($serviceLocator, 'getServiceLocator')) {
            $serviceLocator = $serviceLocator->getServiceLocator();
        }
        // @codeCoverageIgnoreEnd

        return $this($serviceLocator, '');
    }
}
