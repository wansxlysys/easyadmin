<?php


namespace app\common\util;


class DateUtil
{
    /**
     * 当前日期
     * @return false|string
     */
    public static function date()
    {
        return date('Y-m-d');
    }
}