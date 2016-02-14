<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

return function (Slim\App $app) {
    $container = $app->getContainer();
    $events    = $container['events'];

    $events('on', 'app.config', function () {
        return [
            'container' => [
                'extensions' => [
                    'view' => [
                        'twig_debug' => function ($view, $c) {
                            $view->addExtension(new Twig_Extension_Debug());

                            return $view;
                        },
                    ],
                    'logger' => [
                        'debug_log' => function ($logger, $c) {
                            $settings = $c->get('settings');
                            $logger->pushHandler(new Monolog\Handler\StreamHandler(
                                $settings['logger']['debug_path'],
                                Monolog\Logger::DEBUG
                            ));

                            return $logger;
                        },
                    ],
                ],
            ],
        ];
    });

    return [];
};
