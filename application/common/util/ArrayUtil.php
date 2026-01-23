<?php


namespace app\common\util;


class ArrayUtil
{
    /**
     * 转字符串
     * @param array $array
     * @param string $symbol
     * @param string $default
     * @return string
     */
    public static function toString(array $array, $symbol = ',', $default = '')
    {
        if (empty($array)) {
            return $default;
        }

        return implode($symbol, $array);
    }

    /**
     * 数组转json
     * @param array $array
     * @return false|string
     */
    public static function toJson(array $array)
    {
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 检测数组元素是否都符合指定条件
     * @param array $array
     * @param $callback
     * @return bool
     */
    public static function every(array $array, $callback)
    {
        $resolve = function ($carry, $item) use ($callback) {
            return $carry && call_user_func($callback, $item);
        };

        return array_reduce($array, $resolve, true);
    }

    /**
     * 检测数组元素是否有元素符合指定条件
     * @param array $array
     * @param $callback
     * @return bool
     */
    public static function some(array $array, $callback)
    {
        $resolve = function ($carry, $item) use ($callback) {
            return $carry || call_user_func($callback, $item);
        };

        return array_reduce($array, $resolve, true);
    }

    /**
     * 数组分组
     * @param $key
     * @param $array
     * @return array
     */
    public static function groupBy($key, $array)
    {
        $result = [];

        foreach ($array as $item) {
            $result[$key][] = $item;
        }

        return $result;
    }

    /**
     * 唯一数组分组
     * @param $key
     * @param $array
     * @return array
     */
    public static function uniqueBy($key, $array)
    {
        $result = [];

        foreach ($array as $item) {
            if (!isset($result[$key])) {
                $result[$key] = $item;
            }
        }

        return $result;
    }
}