<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic;

return [

    Module::class => [

        'collections' => [
            'd.js' => [
                'a.js',
                'b.js',
                'c.js',
            ],
            'c.css' => [
                'a.css',
                'b.css',
            ],
        ],

        'paths' => [
        ],

        'maps' => [
            'a.js' => './assets/a.js',
            'b.js' => './assets/b.js',
            'c.js' => './assets/c.js',
            'a.css' => './assets/a.css',
            'b.css' => './assets/b.css',
        ],

        'filters' => [
            'd.js' => [
                'filter' => \Assetic\Filter\JSMinFilter::class,
                'options' => []
            ]
        ],

        'caching' => [
            // 'd.js' => [
            //     // 'cache' => Cache\FilePathCache::class,
            //     // 'cache' => ApcCache::class,
            //     // 'cache' => FilesystemCache::class,
            //     // 'options' => [
            //     //     // 'filename' => 'd.js',
            //     //     // 'dirname' => './public'
            //     // ]
            //     'cache' => Cache\StorageCache::class,
            //     'options' => [
            //         // 'adapter' => [
            //         //     'name' => 'Filesystem',
            //         //     'options' => [
            //         //         'cache_dir' => './data/cache/assets',
            //         //         'ttl' => 3600
            //         //     ]
            //         // ],
            //         // 'plugins' => [
            //         //     [
            //         //         'name' => 'serializer',
            //         //         'options' => []
            //         //     ],
            //         //     'exception_handler' => [
            //         //         'throw_exceptions' => true
            //         //     ],
            //         // ]
            //     ]
            // ]
        ]
    ]
];
