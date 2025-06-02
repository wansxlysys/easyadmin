<?php


namespace app\common\helper;


class RepeatHelper
{
    /**
     * 判断是否重复请求
     * @param $params
     * @param $timeout
     * @param $value
     * @return bool
     */
    public static function isRepeat($params, $timeout = 1, $value = 1)
    {
        return RedisHelper::set($params, $value, 'ex', $timeout, 'nx') != 'OK';
    }
}