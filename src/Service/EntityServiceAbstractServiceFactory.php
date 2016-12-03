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
use PolderKnowledge\EntityService\EntityService;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Abstract service factory to create a DefaultEntityService
 */
class EntityServiceAbstractServiceFactory implements AbstractFactoryInterface
{
    const REPOSITORY_SERVICE_KEY = 'EntityRepositoryManager';

    /**
     * {@inheritdoc}
     */
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        return class_exists($requestedName);
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityRepositoryManager = $container->get(self::REPOSITORY_SERVICE_KEY, $options);

        return new EntityService($entityRepositoryManager->get($requestedName), $requestedName);
    }

    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return $this->canCreate($serviceLocator, $requestedName);
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        // @codeCoverageIgnoreStart
        if (method_exists($serviceLocator, 'getServiceLocator')) {
            $serviceLocator = $serviceLocator->getServiceLocator();
        }
        // @codeCoverageIgnoreEnd

        return $this($serviceLocator, $requestedName);
    }
}
