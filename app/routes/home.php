<?php

$app->get('/', function () use ($app) {
    $app->getLog()->info('Home route');
    $app->render('home.html');
});
