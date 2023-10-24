<?php


namespace app\common\helper;


use think\facade\Session;
use app\common\util\StringUtil;
use app\common\enum\ManagerEnum;
use app\common\enum\ManagerRoleEnum;

class ManagerHelper
{
    /**
     * 设置登录信息
     * @param $managerId
     */
    public static function login($managerId)
    {
        Session::set(ManagerEnum::SESSION_ID, $managerId);
    }

    /**
     * 退出登录
     */
    public static function logout()
    {
        Session::delete(ManagerEnum::SESSION_ID);
    }

    /**
     * 获取登录管理ID
     * @return mixed
     */
    public static function getManagerId()
    {
        return Session::get(ManagerEnum::SESSION_ID);
    }

    /**
     * 检测用户是否登录
     * @return bool
     */
    public static function isLogin()
    {
        return Session::has(ManagerEnum::SESSION_ID);
    }

    /**
     * 获取管理员
     * @return mixed|null
     */
    public static function getManager()
    {
        return StorageHelper::get(ManagerEnum::CONTAINER_MANAGER);
    }

    /**
     * 获取角色
     * @return mixed|null
     */
    public static function getRole()
    {
        return StorageHelper::get(ManagerEnum::CONTAINER_MANAGER_ROLE);
    }

    /**
     * 获取角色名称
     * @return mixed
     */
    public static function getIdentify()
    {
        return static::getRole()['identify'];
    }

    /**
     * 获取权限
     * @return mixed|null
     */
    public static function getPermission()
    {
        return static::getRole()['permission'];
    }

    /**
     * 是否为超级管理员
     * @return bool
     */
    public static function isSuper()
    {
        return static::getIdentify() == ManagerRoleEnum::SUPER_NAME;
    }

    /**
     * 是否非超级管理员
     * @return bool
     */
    public static function isNotSuper()
    {
        return static::getIdentify() != ManagerRoleEnum::SUPER_NAME;
    }

    /**
     * 检测账号是否被禁用
     * @return bool
     */
    public static function isDisabled()
    {
        return static::getManager()['status'] == ManagerEnum::STATUS_DISABLED;
    }

    /**
     * 通过菜单ID检测访问权限
     * @param $menuId
     * @param string $condition
     * @return bool
     */
    public static function checkAccessByMenuId($menuId, $condition = 'and')
    {
        return PermissionHelper::checkPermission(StringUtil::toArray($menuId),
            static::getPermission(), $condition);
    }
}