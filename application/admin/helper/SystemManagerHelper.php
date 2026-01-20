<?php


namespace app\admin\helper;


use Exception;

use think\facade\Session;

use app\common\enum\YesnoEnum;
use app\common\util\Md5Util;
use app\common\util\StringUtil;
use app\common\util\PermissionUtil;
use app\common\context\ContextHolder;
use app\common\dependency\Dependency;

use app\admin\enum\SystemManagerEnum;
use app\admin\enum\SystemManagerRoleEnum;
use app\admin\service\SystemManagerService;

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

        Session::set(SystemManagerEnum::SESSION_ID, $managerId);
        Session::set(SystemManagerEnum::SESSION_CODE, $verifyCode);
    }

    /**
     * 退出登录
     */
    public static function logout()
    {
        Session::delete(SystemManagerEnum::SESSION_ID);
    }

    /**
     * 验证
     * @param $account
     * @param $password
     * @return bool
     */
    public static function verify($account, $password)
    {
        return Session::get(SystemManagerEnum::SESSION_CODE) == Md5Util::encrypt($account . $password);
    }

    /**
     * 获取登录管理ID
     * @return mixed
     */
    public static function getManagerId()
    {
        return Session::get(SystemManagerEnum::SESSION_ID);
    }

    /**
     * 检测用户是否登录
     * @return bool
     */
    public static function isLogin()
    {
        return Session::has(SystemManagerEnum::SESSION_ID);
    }

    /**
     * 设置管理员
     * @param $manager
     */
    public static function setManager($manager)
    {
        ContextHolder::set(SystemManagerEnum::LOGIN_MANAGER, $manager);
    }

    /**
     * 获取管理员
     * @return mixed
     * @throws Exception
     */
    public static function getManager()
    {
        return ContextHolder::get(SystemManagerEnum::LOGIN_MANAGER, function () {
            return Dependency::getProxy(SystemManagerService::class)->getLoginManager();
        });
    }

    /**
     * 获取角色名称
     * @return mixed
     * @throws Exception
     */
    public static function getIdentify()
    {
        return static::getManager()['identify'];
    }

    /**
     * 获取权限菜单
     * @return mixed
     * @throws Exception
     */
    public static function getPermissionMenuIds()
    {
        return static::getManager()['permissionMenuIds'];
    }

    /**
     * 获取权限编码
     * @return mixed
     * @throws Exception
     */
    public static function getPermissionMenuIdentify()
    {
        return static::getManager()['permissionMenuIdentify'];
    }

    /**
     * 是否为超级管理员
     * @return bool
     * @throws Exception
     */
    public static function isSuper()
    {
        return static::getIdentify() == SystemManagerRoleEnum::SUPER_NAME;
    }

    /**
     * 是否非超级管理员
     * @return bool
     * @throws Exception
     */
    public static function isNotSuper()
    {
        return static::getIdentify() != SystemManagerRoleEnum::SUPER_NAME;
    }

    /**
     * 检测账号是否被禁用
     * @return bool
     * @throws Exception
     */
    public static function isEnabled()
    {
        return static::getManager()['status'] == SystemManagerEnum::STATUS_ENABLED;
    }

    /**
     * 检测账号是否被删除
     * @return bool
     * @throws Exception
     */
    public static function isDelete()
    {
        return static::getManager()['isDelete'] == YesnoEnum::Y;
    }

    /**
     * 通过菜单ID检测访问权限
     * @param $menuId
     * @param string $condition
     * @return bool
     * @throws Exception
     */
    public static function checkAccessByMenuIds($menuId, $condition = 'and')
    {
        return PermissionUtil::checkPermission(StringUtil::toArray($menuId), static::getPermissionMenuIds(), $condition);
    }

    /**
     * 通过菜单编码检测访问权限
     * @param $menuId
     * @param string $condition
     * @return bool
     * @throws Exception
     */
    public static function checkAccessByMenuIdentify($menuId, $condition = 'and')
    {
        return PermissionUtil::checkPermission(StringUtil::toArray($menuId), static::getPermissionMenuIdentify(), $condition);
    }
}