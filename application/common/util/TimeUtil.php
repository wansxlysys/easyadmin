<?php


namespace app\common\util;


class TimeUtil
{
    /**
     * 当前时间
     * @return string
     */
    public static function time()
    {
        return date('H:i:s');
    }
}