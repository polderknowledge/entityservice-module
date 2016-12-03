<?php
/**
 * Polder Knowledge / entityservice-module (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/entityservice-module for the canonical source repository
 * @copyright Copyright (c) 2016 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/entityservice-module/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\EntityService\Service;

use PolderKnowledge\EntityService\EntityServiceInterface;
use PolderKnowledge\EntityService\Event\EventManagerInitializer;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\InvalidServiceException;

/**
 * Plugin manager for EntityServiceInterfaces
 */
class EntityServiceManager extends AbstractPluginManager
{
    public function __construct($configInstanceOrParentLocator, array $config)
    {
        parent::__construct($configInstanceOrParentLocator, $config);

        $this->addAbstractFactory(EntityServiceAbstractServiceFactory::class);

        $this->autoAddInvokableClass = false;

        $this->instanceOf = EntityServiceInterface::class;
    }

    public function validate($instance)
    {
        if (empty($this->instanceOf) || $instance instanceof $this->instanceOf) {
            return;
        }

        throw new InvalidServiceException(sprintf(
            'Plugin manager "%s" expected an instance of type "%s", but "%s" was received',
            __CLASS__,
            $this->instanceOf,
            is_object($instance) ? get_class($instance) : gettype($instance)
        ));
    }

    // @codeCoverageIgnoreStart
    public function validatePlugin($plugin)
    {
        $this->validate($plugin);
    }
    // @codeCoverageIgnoreEnds
}
