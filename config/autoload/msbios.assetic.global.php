<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic;

return [

    Module::class => [

        'collections' => [
            'c.js' => [
                'a.js',
                'b.js',
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
            'a.css' => './assets/a.css',
            'b.css' => './assets/b.css',
        ],

        'filters' => [
        ],

        'caching' => [
        ],
    ],
];
