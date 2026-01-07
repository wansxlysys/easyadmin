<?php


namespace app\admin\helper;


use think\facade\Session;

use app\common\util\Md5Util;
use app\common\util\StringUtil;
use app\common\enum\YesnoEnum;
use app\common\context\ContextHolder;
use app\common\helper\PermissionHelper;

use app\admin\enum\ManagerEnum;
use app\admin\enum\ManagerRoleEnum;

class SystemManagerHelper
{
    /**
     * 设置登录信息
     * @param $managerId
     * @param $account
     * @param $password
     */
    public static function login($managerId, $account, $password)
    {
        $verifyCode = Md5Util::encrypt($account . $password);

        Session::set(ManagerEnum::SESSION_ID, $managerId);
        Session::set(ManagerEnum::SESSION_CODE, $verifyCode);
    }

    /**
     * 退出登录
     */
    public static function logout()
    {
        Session::delete(ManagerEnum::SESSION_ID);
    }

    /**
     * 验证
     * @param $account
     * @param $password
     * @return bool
     */
    public static function verify($account, $password)
    {
        return Session::get(ManagerEnum::SESSION_CODE) == Md5Util::encrypt($account . $password);
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
     * 设置管理员
     * @param $manager
     */
    public static function setManager($manager)
    {
        ContextHolder::set(ManagerEnum::LOGIN_MANAGER, $manager);
    }

    /**
     * 获取管理员
     * @return mixed|null
     */
    public static function getManager()
    {
        return ContextHolder::get(ManagerEnum::LOGIN_MANAGER);
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
    public static function isEnabled()
    {
        return static::getManager()['status'] == ManagerEnum::STATUS_ENABLED;
    }

    /**
     * 检测账号是否被删除
     * @return bool
     */
    public static function isDelete()
    {
        return static::getManager()['isDelete'] == YesnoEnum::YES;
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