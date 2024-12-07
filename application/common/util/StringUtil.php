<?php


namespace app\common\util;


class StringUtil
{
    /**
     * 转数组
     * @param $string
     * @param string $symbol
     * @param array $default
     * @return array
     */
    public static function toArray($string, $symbol = ',', $default = [])
    {
        if (empty($string)) {
            return $default;
        }

        return explode($symbol, $string);
    }
}