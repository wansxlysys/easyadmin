<?php


namespace app\common\taglib\parser;


use app\admin\helper\SystemManagerHelper;

class PermissionParser
{
    public function checkMenuIds(array $params)
    {
        return SystemManagerHelper::checkAccessByMenuIds($params['menuIds'], $params['condition']);
    }

    public function checkIdentify(array $params)
    {
        return SystemManagerHelper::checkAccessByMenuIdentify($params['identify'], $params['condition']);
    }
}