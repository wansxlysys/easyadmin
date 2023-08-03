<?php


namespace app\common\util;


class ArrayUtil
{
    /**
     * 数组转json
     * @param $array
     * @return false|string
     */
    public static function toJson($array)
    {
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 检测数组元素是否都符合指定条件
     * @param $array
     * @param $callback
     * @return bool
     */
    public static function every($array, $callback)
    {
        $resolve = function ($carry, $item) use ($callback) {
            return $carry && call_user_func($callback, $item);
        };

        return array_reduce($array, $resolve, true);
    }

    /**
     * 检测数组元素是否有元素符合指定条件
     * @param $array
     * @param $callback
     * @return bool
     */
    public static function some($array, $callback)
    {
        $resolve = function ($carry, $item) use ($callback) {
            return $carry || call_user_func($callback, $item);
        };

        return array_reduce($array, $resolve, true);
    }
}