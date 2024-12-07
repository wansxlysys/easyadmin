<?php


namespace app\common\util;


class DateTimeUtil
{
    /**
     * 当前日期时间
     * @return string
     */
    public static function dateTime()
    {
        return date('Y-m-d H:i:s');
    }
}