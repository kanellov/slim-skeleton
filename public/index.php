<?php
chdir(dirname(__DIR__));

require __DIR__ . '/../vendor/autoload.php';

use Slim\Slim;

$bootstrap = include 'app/bootstrap.php';
$bootstrap(new Slim(Knlv\config_merge('config', array(
    'global',
    'local',
))))->run();
