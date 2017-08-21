<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic;

use Zend\ServiceManager\Factory\InvokableFactory;

return [

    'service_manager' => [
        'invokables' => [
            // Listeners
            Listener\AssetListener::class,

            // Reolvers
            Resolver\MimeResolver::class
        ],
        'factories' => [
            Module::class =>
                Factory\ModuleFactory::class,

            // Managers
            AssetManagerInterface::class => Factory\AssetManagerFactory::class,
            CacheManager::class => InvokableFactory::class,
            FilterManager::class => InvokableFactory::class,
            ResolverManager::class => Factory\ResolverManagerFactory::class,

            // Reolvers
            Resolver\CollectionResolver::class =>
                Factory\CollectionResolverFactory::class,
            Resolver\MapResolver::class =>
                Factory\MapResolverFactory::class,
            Resolver\PathStackResolver::class => Factory\PathStackResolverFactory::class,
        ],

        'aliases' => [
            AssetManager::class => AssetManagerInterface::class
        ]
    ],

    'controllers' => [
        'invokables' => [
            Controller\IndexController::class,
        ],
    ],

    Module::class => [

        'default_cleanup_buffer' => true,

        'listeners' => [
            Listener\AssetListener::class => [
                'listener' => Listener\AssetListener::class,
                'method' => 'onDispatchError',
                'event' => \Zend\Mvc\MvcEvent::EVENT_DISPATCH_ERROR,
                'priority' => 1,
            ],
        ],

        'resolvers' => [
            Resolver\MapResolver::class => 100900,
            Resolver\CollectionResolver::class => 100700,
            Resolver\PathStackResolver::class => 100500,
        ],

        'collections' => [
        ],

        'paths' => [
        ],

        'maps' => [
        ],

        'filters' => [
        ],

        'caching' => [
        ],

        // 'view_helper' => [
        //     'cache' => 'Application\Cache\Redis',
        //  // You will need to require the factory used for the cache yourself.
        //     'append_timestamp' => true, // optional, if false never append a query param
        //     'query_string' => '_', // optional
        // ],
        //

    ],
];
