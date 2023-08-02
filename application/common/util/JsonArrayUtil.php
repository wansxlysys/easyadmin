<?php


namespace app\common\util;


class JsonArrayUtil
{
    /**
     * json转数组
     * @param $json
     * @return mixed
     */
    public static function jsonToArray($json)
    {
        return json_decode($json, true);
    }

    /**
     * 数组转json
     * @param $array
     * @return false|string
     */
    public static function arrayToJson($array)
    {
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }
}