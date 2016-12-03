<?php
/**
 * Polder Knowledge / entityservice-module (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/entityservice-module for the canonical source repository
 * @copyright Copyright (c) 2016 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/entityservice-module/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\EntityService\Repository\Service;

use PolderKnowledge\EntityService\Exception\InvalidServiceException;
use PolderKnowledge\EntityService\Repository\Feature\DeletableInterface;
use PolderKnowledge\EntityService\Repository\Feature\FlushableInterface;
use PolderKnowledge\EntityService\Repository\Feature\ReadableInterface;
use PolderKnowledge\EntityService\Repository\Feature\WritableInterface;
use Zend\ServiceManager\AbstractPluginManager;

/**
 * Plugin manager for entity repositories used by entity services
 */
class EntityRepositoryManager extends AbstractPluginManager
{
    /**
     * {@inheritDoc}
     */
    public function __construct($configInstanceOrParentLocator = null, array $config = [])
    {
        parent::__construct($configInstanceOrParentLocator, $config);

        $this->autoAddInvokableClass = false;
    }


    // @codeCoverageIgnoreStart
    public function validatePlugin($plugin)
    {
    }
    // @codeCoverageIgnoreEnd

    /**
     * {@inheritDoc}
     */
    public function validate($instance)
    {
        if ($instance instanceof DeletableInterface ||
            $instance instanceof FlushableInterface ||
            $instance instanceof ReadableInterface ||
            $instance instanceof WritableInterface) {
            return;
        }

        throw new InvalidServiceException(sprintf(
            'Plugin manager "%s" expected a type of %s, %s, %s or %s but received "%s"',
            __CLASS__,
            DeletableInterface::class,
            FlushableInterface::class,
            ReadableInterface::class,
            WritableInterface::class,
            is_object($instance) ? get_class($instance) : gettype($instance)
        ));
    }
}
