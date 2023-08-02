<?php


namespace app\common\helper;


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
            $allow = !empty($allow) ? explode(',', $allow) : [];
        }

        foreach ($allow as $key => $id) {

            $result = in_array($id, $permission);

            if ($result == true && $condition == 'or') {
                return true;
            }

            if ($result == false && $condition === 'and') {
                return false;
            }
        }

        return $condition === 'and';
    }
}