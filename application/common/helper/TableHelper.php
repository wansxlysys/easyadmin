<?php


namespace app\common\helper;


class TableHelper
{
    /**
     * 取余方式分表
     * @param int $value 分表值
     * @param int $total 表总数量
     * @param int $initial 初始数量
     * @return int
     */
    public static function mod($value, $total, $initial = 1)
    {
        return ($value % $total) + $initial;
    }
}