<?php


namespace app\common\taglib\parser;


use app\common\util\ArrayUtil;

class OutputParser
{
    /**
     * @param array $params
     * @return string
     */
    public function getScript(array $params)
    {
        return "<script> const {$params['value']} = " . ArrayUtil::toJson($params['data']) . "</script>";
    }
}