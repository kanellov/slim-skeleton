<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

return function (Slim\App $app) {

    $container  = $app->getContainer();
    $autoloader = $container['autoloader'];
    $events     = $container['events'];

    $autoloader->addPsr4('App\\', __DIR__ . '/src');

    $events('on', 'app.config', function () {
        return [
            'settings' => [
                'view' => [
                    'template_path' => __DIR__ . '/templates',
                ],
            ],
            'container' => [
                'services' => [
                    'view' => function ($c) {
                        $settings = $c->get('settings');
                        $view = new \Slim\Views\Twig(
                            $settings['view']['template_path'],
                            $settings['view']['twig']
                        );
                        $view->addExtension(new Slim\Views\TwigExtension(
                            $c->get('router'),
                            $c->get('request')->getUri()
                        ));

                        return $view;
                    },
                ],
            ],
        ];
    });

    return include __DIR__ . '/config/module.config.php';
};
