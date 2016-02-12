<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace Knlv\Slim;

use Interop\Container\ContainerInterface;
use InvalidArgumentException;
use Slim\App;

class AddRoutes
{
    public function __invoke(App $app, array $routes)
    {
        if (empty($routes)) {
            return;
        }

        if (array_values($routes) === $routes) {
            throw new InvalidArgumentException('Routes array must have route names as keys');
        }

        uasort($routes, [$this, 'prioritizeRoutes']);

        $that = $this;

        foreach ($routes as $name => $config) {
            if (!isset($config['pattern'])) {
                throw new InvalidArgumentException('Route must have a pattern');
            }
            if (isset($config['children']) && is_array($config['children'])) {
                $group = $app->group($config['pattern'], function () use ($that, $app, $config) {
                    $that($app, $config['children']);
                });
                $this->addMiddleware($group, $config, $app->getContainer());
            }
            $route = $this->createRoute($app, $config);
            $route->setName($name);
        }
    }

    private function createRoute(App $app, array $config)
    {
        if (!isset($config['handler'])) {
            throw new InvalidArgumentException('Route must have a handler');
        }

        $container = $app->getContainer();
        $this->validateCallable($config['handler'], $container);

        $pattern = $config['pattern'];
        $handler = $config['handler'];
        $methods = array_unique($config['methods'] ?: ['GET']);
        $route   = $app->map($methods, $pattern, $handler);

        if (isset($config['output_buffering'])) {
            $route->setOutputBuffering($config['output_buffering']);
        }
        $this->addMiddleware($route, $config, $container);

        return $route;
    }

    private function addMiddleware($route, array $config, ContainerInterface $container)
    {
        if (isset($config['middleware']) && is_array($config['middleware'])) {
            foreach ($config['middleware'] as $middleware) {
                $this->validateCallable($middleware, $container);
                $route->add($middleware);
            }
        }

        return $route;
    }

    private function prioritizeRoutes($route1, $route2)
    {
        if (!isset($route1['priority'])) {
            $route1['priority'] = 1;
        }

        if (!isset($route2['priority'])) {
            $route2['priority'] = 1;
        }
        if ((int) $route1['priority'] === (int) $route2['priority']) {
            return 0;
        }

        return $route1['priority'] > $route2['priority'] ? -1 : 1;
    }

    private function validateCallable($callable, ContainerInterface $container)
    {
        if ((is_string($callable) && $container->has($callable)) || is_callable($callable)) {
            return;
        }

        throw new InvalidArgumentException('Cannot resolve callable');
    }
}
