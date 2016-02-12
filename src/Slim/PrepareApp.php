<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace Knlv\Slim;

use Slim\App;

class PrepareApp
{
    public function __invoke(App $app, array $appConfig = [])
    {
        $addSettings   = new AddSettings();
        $addServices   = new AddServices();
        $addRoutes     = new AddRoutes();
        $addMiddleware = new AddMiddleware();

        $settings   = $appConfig['settings'] ?: [];
        $services   = $appConfig['services'] ?: [];
        $routes     = $appConfig['routes'] ?: [];
        $middleware = $appConfig['middleware'] ?: [];

        return $addMiddleware(
                    $addRoutes(
                       $addServices(
                            $addSettings($app, $settings),
                            $services
                        ),
                        $routes
                    ),
                    $middleware
                );
    }
}
