<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace Knlv\Slim;

use Knlv\Utils\PriorityComparatorTrait;
use Knlv\Utils\ValidateCallableTrait;
use Slim\App;

class AddMiddleware
{
    use PriorityComparatorTrait;
    use AddMiddlewareTrait;
    use ValidateCallableTrait;

    private $container;

    public function __invoke(App $app, array $config)
    {
        if (empty($config)) {
            return $app;
        }

        $this->container = $app->getContainer();
        $this->addMiddleware($app, $config);

        return $app;
    }

    private function getContainer()
    {
        return $this->container;
    }
}
