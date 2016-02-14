<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

return [
    'container' => [
        'invokables' => [
            'flash' => Slim\Flash\Messages::class,
        ],
        'services' => [
            'logger'                         => App\Service\Monolog::class,
            App\Action\Index::class          => App\Action\IndexFactory::class,
            App\Middleware\LogRequest::class => App\Middleware\LogRequestFactory::class,
        ],
    ],
    'middleware' => [
        'log-request' => [
            'handler' => App\Middleware\LogRequest::class,
        ],
    ],
    'routes' => [
        'index' => [
            'pattern' => '/',
            'handler' => App\Action\Index::class,
        ],
    ],

];
