<?php


namespace app\common\taglib\parser;


use Exception;

use app\admin\helper\SystemManagerHelper;

class PermissionParser
{
    /**
     * 检查菜单ID
     * @throws Exception
     */
    public function checkMenuIds(array $params)
    {
        return SystemManagerHelper::checkAccessByMenuIds($params['menuIds'], $params['condition']);
    }

    /**
     * 检查权限标识
     * @throws Exception
     */
    public function checkIdentify(array $params)
    {
        return SystemManagerHelper::checkAccessByMenuIdentify($params['identify'], $params['condition']);
    }
}