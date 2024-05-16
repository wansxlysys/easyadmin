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
        Session::set(ManagerEnum::LOGIN_ID, $managerId);
    }

    /**
     * 退出登录
     */
    public static function logout()
    {
        Session::delete(ManagerEnum::LOGIN_ID);
    }

    /**
     * 获取登录管理ID
     * @return mixed
     */
    public static function getManagerId()
    {
        return Session::get(ManagerEnum::LOGIN_ID);
    }

    /**
     * 检测用户是否登录
     * @return bool
     */
    public static function isLogin()
    {
        return Session::has(ManagerEnum::LOGIN_ID);
    }

    /**
     * 设置管理员
     * @param $manager
     */
    public static function setManager($manager)
    {
        StoreHelper::set(ManagerEnum::LOGIN_MANAGER, $manager);
    }

    /**
     * 获取管理员
     * @return mixed|null
     */
    public static function getManager()
    {
        return StoreHelper::get(ManagerEnum::LOGIN_MANAGER);
    }

    /**
     * 获取角色名称
     * @return mixed
     */
    public static function getIdentify()
    {
        return static::getManager()['identify'];
    }

    /**
     * 获取权限
     * @return mixed|null
     */
    public static function getPermission()
    {
        return static::getManager()['permission'];
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
        return PermissionHelper::checkPermission(StringUtil::toArray($menuId), static::getPermission(), $condition);
    }
}