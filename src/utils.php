<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace Knlv;

function merge_arrays(array $merged, array $new)
{
    static $merge_arrays;
    $merge_arrays = new Knlv\Utils\MergeArrays();

    return $merge_arrays($merged, $new);
}

function cache_array(array $data, $file)
{
    static $cache_array;
    $cache_array = new Knlv\Utils\CacheArray();

    return $cache_array($data, $file);
}
