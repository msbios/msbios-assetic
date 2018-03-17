<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic;

use Zend\ServiceManager\Factory\InvokableFactory;

return [

    'service_manager' => [
        'factories' => [
            Module::class =>
                Factory\ModuleFactory::class,

            // Listeners
            Listener\DispatchErrorListener::class =>
                Factory\DispatchErrorListenerFactory::class,

            // Managers
            AssetManager::class =>
                Factory\AssetManagerFactory::class,
            CacheManager::class =>
                InvokableFactory::class,
            FilterManager::class =>
                InvokableFactory::class,
            ResolverManager::class =>
                Factory\ResolverManagerFactory::class,

            // Resolvers
            Resolver\CollectionResolver::class =>
                Factory\CollectionResolverFactory::class,
            Resolver\MapResolver::class =>
                Factory\MapResolverFactory::class,
            Resolver\PathStackResolver::class =>
                Factory\PathStackResolverFactory::class,
            Resolver\MimeResolver::class =>
                InvokableFactory::class
        ]
    ],

    Module::class => [

        /**
         *
         * Expects: bool
         * Default: true
         */
        'default_cleanup_buffer' => true,

        /**
         * Enables or disables the deploy.
         *
         * Expects: array
         * Default: [
         *     Listener\AssetListener::class =>
         *         'listener' => Listener\DispatchErrorListener::class,
         *         'method' => 'onDispatchError',
         *         'event' => \Zend\Mvc\MvcEvent::EVENT_DISPATCH_ERROR,
         *         'priority' => 1,
         *     ],
         * ]
         */
        'listeners' => [
            Listener\DispatchErrorListener::class => [
                'listener' => Listener\DispatchErrorListener::class,
                'method' => 'onDispatchError',
                'event' => \Zend\Mvc\MvcEvent::EVENT_DISPATCH_ERROR,
                'priority' => 1,
            ],
        ],

        /**
         *
         * Expects: array
         * Default: [
         *     Resolver\PathStackResolver::class => 100500,
         *     Resolver\CollectionResolver::class => 100700,
         *     Resolver\MapResolver::class => 100900,
         * ]
         */
        'resolvers' => [
            Resolver\PathStackResolver::class => 100500,
            Resolver\CollectionResolver::class => 100700,
            Resolver\MapResolver::class => 100900,
        ],

        /**
         *
         * Expects: array
         * Default: [
         *     // ...
         * ]
         */
        'collections' => [
        ],

        /**
         *
         * Expects: array
         * Default: [
         *     // ...
         * ]
         */
        'paths' => [
        ],

        /**
         *
         * Expects: array
         * Default: [
         *     // ...
         * ]
         */
        'maps' => [
        ],

        /**
         *
         * Expects: array
         * Default: [
         *     // ...
         * ]
         */
        'filters' => [
        ],

        /**
         *
         * Expects: array
         * Default: [
         *     // ...
         * ]
         */
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