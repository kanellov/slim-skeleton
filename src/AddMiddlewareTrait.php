<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace Knlv\Slim\Modules;

use InvalidArgumentException;
use Slim\App;
use Slim\Routable;

trait AddMiddlewareTrait
{

    private function addMiddleware($appOrRoute, array $middleware)
    {
        if (!$appOrRoute instanceof App && !$appOrRoute instanceof Routable) {
            throw new InvalidArgumentException('Expected Slim\\App or Slim\\Routable');
        }

        if (array_values($middleware) === $middleware) {
            throw new InvalidArgumentException('Middleware array must have names as keys');
        }

        $middleware = array_map(function ($mw) {
            if (!is_array($mw)) {
                $mw = [
                    'handler'    => $mw,
                    'priority'   => 1,
                ];
            }

            return $mw;
        }, $middleware);

        $middleware = $this->prioritize($middleware, true);

        foreach ($middleware as $mw) {
            if (!isset($mw['handler'])) {
                throw new InvalidArgumentException('Must define a middleware handler');
            }
            $this->validateCallable($mw['handler']);
            $appOrRoute->add($mw['handler']);
        }

        return $appOrRoute;
    }

    abstract protected function validateCallable($callable);

    abstract protected function prioritize(array $config, $reversed = false);
}
