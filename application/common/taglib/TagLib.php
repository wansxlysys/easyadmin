<?php


namespace app\common\taglib;


use app\common\exception\ServiceException;

class TagLib extends \think\template\TagLib
{
    /**
     * 将非变量和函数的字符串加上引号
     * @param $tag
     * @param $name
     * @param $require
     * @param string $default
     * @return string
     */
    public function parseVar($tag, $name, $require, $default = null)
    {
        if (isset($tag[$name])) {
            return $this->autoParseVar($tag[$name]);
        }

        if ($require) {
            throw new ServiceException($name . '属性不能为空');
        }

        return $this->autoParseVar($default);
    }

    /**
     * 构建变量
     * @param $variable
     * @return float|int|string
     */
    public function autoParseVar($variable)
    {
        $flag = substr($variable, 0, 1);

        if (':' == $flag || '$' == $flag || '[' == $flag) {
            return $this->autoBuildVar($variable);
        }

        if ($variable === null || $variable === 'null') {
            return 'null';
        }

        if ($variable === true || $variable === 'true') {
            return 'true';
        }

        if ($variable === false || $variable === 'false') {
            return 'false';
        }

        if (is_numeric($variable)) {
            return $variable;
        }

        return $this->quotesVar($variable);
    }

    /**
     * 给变量添加引号
     * @param $var
     * @return string
     */
    public function quotesVar($var)
    {
        return '"' . $var . '"';
    }
}