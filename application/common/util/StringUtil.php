<?php


namespace app\common\util;


class StringUtil
{
    /**
     * 唯一字符串
     * @param $slat
     * @return string
     */
    public static function unique($slat = '')
    {
        return md5(microtime() . rand(100000, 999999) . uniqid($slat, true));
    }

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