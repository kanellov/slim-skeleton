<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace App\Middleware;

class LogRequest
{
    private $logger;

    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    public function __invoke($req, $res, $next)
    {
        $this->logger->info($req->getUri(), [
            'method'  => $req->getMethod(),
            'headers' => $req->getHeaders(),
        ]);

        return $next($req, $res);
    }
}
