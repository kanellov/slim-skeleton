<?php return array(
    'mode'           => 'development',
    'debug'          => true,
    'view'           => 'Slim\Views\Twig',
    'templates.path' => 'templates',
    'log.enabled'    => true,
    'log.level'      => Monolog\Logger::DEBUG,
    'view.parser'    => array(
        'options'    => array(
            'charset'          => 'utf-8',
            'cache'            => 'data/cache/templates',
            'auto_reload'      => true,
            'strict_variables' => true,
            'autoescape'       => true,
        ),
        'extensions' => array(
            'Slim\Views\TwigExtension',
        ),
    ),
);
