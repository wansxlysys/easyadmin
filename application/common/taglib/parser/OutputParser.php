<?php


namespace app\common\taglib\parser;


use app\common\util\ArrayUtil;

class OutputParser
{
    /**
     * 获取输出脚本
     * @param array $params
     * @return string
     */
    public function getScript(array $params)
    {
        return "<script> const {$params['value']} = " . ArrayUtil::toJson($params['data']) . "</script>";
    }
}