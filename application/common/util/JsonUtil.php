<?php


namespace app\common\util;


class JsonUtil
{
    /**
     * json转数组
     * @param $json
     * @return mixed
     */
    public static function toArray($json)
    {
        return json_decode($json, true);
    }
}