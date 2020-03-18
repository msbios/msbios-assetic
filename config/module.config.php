<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic;

use Laminas\ServiceManager\Factory\InvokableFactory;
use MSBios\Factory\ModuleFactory;

return [

    'service_manager' => [
        'factories' => [
            AssetListenerAggregate::class =>
                Factory\AssetListenerAggregateFactory::class,

            Module::class =>
                ModuleFactory::class,

            // Managers
            AssetManager::class =>
                Factory\AssetManagerFactory::class,
            CacheManager::class =>
                Factory\CacheManagerFactory::class,
            FilterManager::class =>
                Factory\FilterManagerFactory::class,
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
                InvokableFactory::class,

            // Filters
            \Assetic\Filter\JSMinFilter::class =>
                InvokableFactory::class,

            // Caches
            \Assetic\Cache\FilesystemCache::class =>
                Factory\FilesystemCacheFactory::class,
            Cache\FilePathCache::class =>
                InvokableFactory::class,
            Cache\StorageCache::class =>
                Factory\StorageCacheFactory::class
        ]
    ],

    'listeners' => [
        AssetListenerAggregate::class
    ],

    Module::class => [

        /**
         *
         * Expects: bool
         * Default: true
         */
        'default_cleanup_buffer' => true,

        /**
         *
         * Expects: string
         * Default:
         */
        'default_filter_provider' => '',

        /**
         *
         * Expects: string
         * Default:
         */
        'default_cache_provider' => '',

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
            // 'js/d.js' => [
            //     'js/a.js',
            //     'js/b.js',
            //     'js/c.js',
            // ],
        ],

        /**
         *
         * Expects: array
         * Default: []
         */
        'paths' => [
            // __DIR__ . '/some/particular/directory',
        ],

        /**
         *
         * Expects: array
         * Default: []
         */
        'maps' => [
            // 'specific-path.css' => __DIR__ . '/some/particular/file.css',
        ],

        /**
         *
         * Expects: array
         * Default: [
         *     // ...
         * ]
         */
        'filters' => [
            // ...
        ],

        /**
         *
         * Expects: array
         * Default: [
         *     // ...
         * ]
         */
        'caching' => [
            // ...
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
