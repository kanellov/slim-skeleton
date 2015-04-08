<?php

$app->container->singleton('log', function ($c) {
    $loglevel = $c->settings['log.level'];
    $log      = new Monolog\Logger('slim-skeleton');
    $log->pushHandler(
        new Monolog\Handler\StreamHandler('data/logs/app.log', $loglevel)
    );

    return $log;
});
