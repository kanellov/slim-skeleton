<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace App\Middleware;

class LogRequestFactory
{
    public function __invoke($c)
    {
        $logger = $c->get('logger');

        return new LogRequest($logger);
    }
}