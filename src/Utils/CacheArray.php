<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace Knlv\Utils;

class CacheArray
{
    public function __invoke(array $data, $file)
    {
        if ($file && is_readable($file)) {
            return include $file;
        }

        if ($file && is_writable($file)) {
            file_put_contents(
                $this->file,
                '<?php return ' . var_export($data, true) . ';'
            );
        }

        return $data;
    }
}
