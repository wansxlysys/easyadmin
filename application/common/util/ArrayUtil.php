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
}