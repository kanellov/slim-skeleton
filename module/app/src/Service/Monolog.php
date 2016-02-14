<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace App\Service;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;

class Monolog
{
    public function __invoke($c)
    {
        $settings = $c->get('settings');
        $logger   = new Logger($settings['logger']['name']);
        $logger->pushProcessor(new UidProcessor());
        $logger->pushHandler(new StreamHandler(
            $settings['logger']['path'],
            Logger::ERROR
        ));

        return $logger;
    }
}
