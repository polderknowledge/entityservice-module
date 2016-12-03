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

/**
 * Plugin manager for EntityServiceInterfaces
 */
class EntityServiceManagerV2 extends AbstractPluginManager
{
    public function __construct($configInstanceOrParentLocator, array $config)
    {
        parent::__construct($configInstanceOrParentLocator, $config);

        $this->addAbstractFactory(EntityServiceAbstractServiceFactory::class);

        $this->autoAddInvokableClass = false;

        $this->instanceOf = EntityServiceInterface::class;
    }

    // @codeCoverageIgnoreStart
    public function validatePlugin($plugin)
    {
    }
    // @codeCoverageIgnoreEnds
}
