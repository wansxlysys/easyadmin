<?php


namespace app\admin\helper;


use Exception;

use think\facade\Session;

use app\common\util\Md5Util;
use app\common\util\StringUtil;
use app\common\util\PermissionUtil;
use app\common\helper\InjectHelper;
use app\common\helper\ContextHelper;
use app\common\constant\YesnoConstant;

use app\admin\service\SystemManagerService;
use app\admin\constant\SystemManagerConstant;
use app\admin\constant\SystemManagerRoleConstant;

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

        Session::set(SystemManagerConstant::LOGIN_MANAGER_ID, $managerId);
        Session::set(SystemManagerConstant::LOGIN_VERIFY_CODE, $verifyCode);
    }

    /**
     * 退出登录
     */
    public static function logout()
    {
        Session::delete(SystemManagerConstant::LOGIN_MANAGER_ID);
    }

    /**
     * 验证
     * @return bool
     * @throws Exception
     */
    public static function verifyPassword()
    {
        return Session::get(SystemManagerConstant::LOGIN_VERIFY_CODE) == Md5Util::encrypt(static::getManager()['account'] . static::getManager()['password']);
    }

    /**
     * 获取登录管理ID
     * @return mixed
     */
    public static function getManagerId()
    {
        return Session::get(SystemManagerConstant::LOGIN_MANAGER_ID);
    }

    /**
     * 检测用户是否登录
     * @return bool
     */
    public static function isLogin()
    {
        return Session::has(SystemManagerConstant::LOGIN_MANAGER_ID);
    }

    /**
     * 获取管理员
     * @return mixed
     * @throws Exception
     */
    public static function getManager()
    {
        return ContextHelper::get(SystemManagerConstant::LOGIN_MANAGER, function () {
            return InjectHelper::getClass(SystemManagerService::class)->getLoginManager();
        });
    }

    /**
     * 获取角色名称
     * @return mixed
     * @throws Exception
     */
    public static function getRoleIdentify()
    {
        return static::getManager()['roleIdentify'];
    }

    /**
     * 获取角色级别
     * @return mixed
     * @throws Exception
     */
    public static function getRoleLevel()
    {
        return static::getManager()['roleLevel'];
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
        return static::getRoleIdentify() == SystemManagerRoleConstant::SUPER_NAME;
    }

    /**
     * 是否非超级管理员
     * @return bool
     * @throws Exception
     */
    public static function isNotSuper()
    {
        return static::getRoleIdentify() != SystemManagerRoleConstant::SUPER_NAME;
    }

    /**
     * 检测账号是否被禁用
     * @return bool
     * @throws Exception
     */
    public static function isDisabled()
    {
        return static::getManager()['status'] != SystemManagerConstant::STATUS_ENABLED;
    }

    /**
     * 检测账号是否被删除
     * @return bool
     * @throws Exception
     */
    public static function isDeleted()
    {
        return static::getManager()['isDelete'] == YesnoConstant::Y;
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