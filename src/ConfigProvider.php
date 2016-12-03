<?php
/**
 * Polder Knowledge / entityservice-module (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/entityservice-module for the canonical source repository
 * @copyright Copyright (c) 2016 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/entityservice-module/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\EntityService;

use PolderKnowledge\EntityService\Repository\Service\EntityRepositoryManager;
use PolderKnowledge\EntityService\Repository\Service\EntityRepositoryManagerFactory;
use PolderKnowledge\EntityService\Service\EntityServiceManager;
use PolderKnowledge\EntityService\Service\EntityServiceManagerFactory;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencyConfig(),
            'validators' => $this->getValidatorConfig(),
        ];
    }

    public function getDependencyConfig()
    {
        return [
            'aliases' => [
                'EntityRepositoryManager' => EntityRepositoryManager::class,
                'EntityServiceManager' => EntityServiceManager::class,
            ],
            'factories' => [
                EntityRepositoryManager::class => EntityRepositoryManagerFactory::class,
                EntityServiceManager::class => EntityServiceManagerFactory::class,
            ],
        ];
    }

    public function getValidatorConfig()
    {
        return [
            'factories' => [
                'PolderKnowledge\\EntityService\\Validator\\EntityExists' =>
                    'PolderKnowledge\\EntityService\\Validator\\Service\\EntityExistsFactory',
                'PolderKnowledge\\EntityService\\Validator\\EntityNotExists' =>
                    'PolderKnowledge\\EntityService\\Validator\\Service\\EntityNotExistsFactory',
            ],
        ];
    }
}
