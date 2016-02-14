<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace App\Action;

class Index
{
    private $view;

    public function __construct($view)
    {
        $this->view = $view;
    }

    public function __invoke($req, $res)
    {
        return $this->view->render($res, 'index.twig');
    }
}
