<?php


namespace app\common\taglib;


class TagLib extends \think\template\TagLib
{
    /**
     * 给变量添加引号
     * @param $var
     * @return string
     */
    public function quotesVar($var)
    {
        return '"' . $var . '"';
    }

    /**
     * 将非变量和函数的字符串加上引号
     * @param $var
     * @return string
     */
    public function parseVar(&$var)
    {
        $flag = substr($var, 0, 1);

        if (':' == $flag || '$' == $flag) {
            return $this->autoBuildVar($var);
        }

        return $this->quotesVar($var);
    }
}