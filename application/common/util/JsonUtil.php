<?php


namespace app\common\util;


class JsonUtil
{
    /**
     * json转数组
     * @param $json
     * @return array
     */
    public static function toArray($json)
    {
        return json_decode($json, true);
    }

    /**
     * json转对象
     * @param $json
     * @return object
     */
    public static function toObject($json)
    {
        return json_decode($json);
    }
}