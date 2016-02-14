<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace App\Action;

class IndexFactory
{
    public function __invoke($c)
    {
        $view = $c->get('view');

        return new Index($view);
    }
}
