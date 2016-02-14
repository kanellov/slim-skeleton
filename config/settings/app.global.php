<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

 return [
    'determineRouteBeforeAppMiddleware' => false,
    'displayErrorDetails'               => false,
    'view'                              => [
        'twig' => [
            'cache'       => 'data/cache/twig',
            'debug'       => true,
            'auto_reload' => true,
        ],
    ],
    'logger' => [
        'name' => 'app',
        'path' => 'data/log/app.log',
    ],
];
