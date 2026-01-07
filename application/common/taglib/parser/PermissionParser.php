<?php


namespace app\common\taglib\parser;


use app\admin\helper\SystemManagerHelper;

class PermissionParser
{
    public function tagAllow(array $params)
    {
        return SystemManagerHelper::checkAccessByMenuId($params['menuIds'], $params['condition']);
    }
}