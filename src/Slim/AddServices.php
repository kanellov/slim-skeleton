<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace Knlv\Slim;

use InvalidArgumentException;
use Slim\App;
use Slim\Container;

class AddServices
{
    public function __invoke(App $app, array $config)
    {
        if (empty($config)) {
            return $app;
        }

        $container = $app->getContainer();

        if (isset($config['factories']) && is_array($config['factories'])) {
            $this->addFactories($container, $config['factories']);
        }

        if (isset($config['protected']) && is_array($config['protected'])) {
            $this->addProtected($container, $config['protected']);
        }

        if (isset($config['extensions']) && is_array($config['extensions'])) {
            $this->addExtensions($container, $config['extensions']);
        }

        return $app;
    }

    private function addFactories(Container $container, array $factories)
    {
        foreach ($factories as $name => $factory) {
            if (is_string($factory) && !is_callable($factory) && class_exists($factory)) {
                $container[$name] = new $factory();
            } else {
                $container[$name] = $factory;
            }
        }
    }

    private function addProtected(Container $container, array $protected)
    {
        foreach ($protected as $name => $callable) {
            if (!is_callable($callable)) {
                throw new InvalidArgumentException('Protected must be callable');
            }
            $container[$name] = $container->protect($callable);
        }
    }

    private function addExtensions(Container $container, array $extensions)
    {
        foreach ($extensions as $name => $extensionGroup) {
            if (!is_array($extensionGroup)) {
                $extensionGroup = [$extensionGroup];
            }
            foreach ($extensionGroup as $extension) {
                $container->extend($name, $extension);
            }
        }
    }
}
