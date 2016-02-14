<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

chdir(dirname(__DIR__));

if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

$autoloader = require 'vendor/autoload.php';

$appConfig = include 'config/app.config.php';
if (is_readable('config/dev.config.php')) {
    $devConfig                     = include 'config/dev.config.php';
    $appConfig['modules']          = array_unique(array_merge($appConfig['modules'], $devConfig['modules']));
    $appConfig['config_cache']     = isset($devConfig['config_cache']) ? $devConfig['config_cache'] : $appConfig['config_cache'];
    $appConfig['config_glob_path'] = isset($devConfig['config_glob_path']) ? $devConfig['config_glob_path'] : $appConfig['config_glob_path'];
}

$loader = new Knlv\Slim\Modules\AppLoader(new Slim\App(), $autoloader, $appConfig);
$loader->init()->run();
