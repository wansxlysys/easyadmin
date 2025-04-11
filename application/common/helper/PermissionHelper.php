<?php


namespace app\common\helper;


use app\common\util\StringUtil;

class PermissionHelper
{
    /**
     * 权限检测
     * @param $allow
     * @param array $permission
     * @param string $condition
     * @return bool
     */
    public static function checkPermission($allow, array $permission = [], $condition = 'and')
    {
        if (!is_array($allow)) {
            $allow = StringUtil::toArray($allow);
        }

        foreach ($allow as $id) {

            $result = in_array($id, $permission);

            if ($result && $condition == 'or') {
                return true;
            }

            if (!$result && $condition === 'and') {
                return false;
            }
        }

        return $condition === 'and';
    }
}