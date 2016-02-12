<?php
/**
 * kanellov/slim-skeleton
 * 
 * @link https://github.com/kanellov/slim-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Vassilis Kanellopoulos (http://kanellov.com)
 * @license GNU GPLv3 http://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

namespace Knlv\Utils;

class MergeArrays
{
    public function __invoke(array $merged, array $new)
    {
        foreach ($new as $key => $value) {
            if (array_key_exists($key, $merged)) {
                if (is_int($key)) {
                    $merged[] = $value;
                } elseif (is_array($value) && is_array($merged[$key])) {
                    $merged[$key] = $this($merged[$key], $value);
                } else {
                    $merged[$key] = $value;
                }
            } else {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }
}