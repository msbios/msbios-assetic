<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic;

return [

    'service_manager' => [
        'invokables' => [
            // Listeners
            Listener\AssetListener::class,

            // Reolvers
            Resolver\MimeResolver::class
        ],
        'factories' => [

            // Managers
            AssetManager::class =>
                Factory\AssetManagerFactory::class,
            CacheManager::class =>
                \Zend\ServiceManager\Factory\InvokableFactory::class,
            FilterManager::class =>
                \Zend\ServiceManager\Factory\InvokableFactory::class,
            ResolverManager::class =>
                Factory\ResolverManagerFactory::class,

            // Reolvers
            Resolver\CollectionResolver::class =>
                Factory\CollectionResolverFactory::class,
            Resolver\MapResolver::class =>
                Factory\MapResolverFactory::class,
            Resolver\PathStackResolver::class => Factory\PathStackResolverFactory::class,

            Module::class =>
                Factory\ModuleFactory::class,

        ],
    ],

    'controllers' => [
        'invokables' => [
            Controller\IndexController::class,
        ],
    ],

    'console' => [
        'router' => [
            'routes' => [
                'user-reset-password' => [
                    'type' => 'simple',  // This is the default, and may be omitted; more on types below
                    'options' => [
                        'route' => 'user',
                        'defaults' => [
                            'controller' => Controller\IndexController::class,
                            'action' => 'resetpassword',
                        ],
                    ],
                ],
            ],
        ],
    ],

    Module::class => [

        'default_cleanup_buffer' => true,

        'listeners' => [
            [
                'listener' => Listener\AssetListener::class,
                'method' => 'onRender',
                'event' => \Zend\Mvc\MvcEvent::EVENT_RENDER,
                'priority' => -1000050000,
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
