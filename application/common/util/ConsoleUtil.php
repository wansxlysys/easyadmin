<?php


namespace app\common\util;


class ConsoleUtil
{
    /**
     * 换行输出
     * @param $message
     * @return void
     */
    public static function writeln($message)
    {
        echo $message . "\n";
    }
}