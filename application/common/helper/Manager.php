<?php


namespace app\common\helper;


use think\facade\Session;

class Manager
{
    /**
     * 设置登录信息
     * @param $managerId
     */
    public static function login($managerId)
    {
        Session::set(\app\common\constant\Manager::SESSION_ID, $managerId);
    }

    /**
     * 退出登录
     */
    public static function logout()
    {
        Session::delete(\app\common\constant\Manager::SESSION_ID);
    }

    /**
     * 获取登录管理ID
     * @return mixed
     */
    public static function getManagerId()
    {
        return Session::get(\app\common\constant\Manager::SESSION_ID);
    }

    /**
     * 检测用户是否登录
     * @return bool
     */
    public static function isLogin()
    {
        return Session::has(\app\common\constant\Manager::SESSION_ID);
    }

    /**
     * 获取角色
     * @return mixed|null
     */
    public static function getRole()
    {
        return Storage::get(\app\common\constant\Manager::CONTAINER_ROLE);
    }

    /**
     * 获取角色名称
     * @return mixed
     */
    public static function getRoleName()
    {
        return static::getRole()['name'];
    }

    /**
     * 获取管理员
     * @return mixed|null
     */
    public static function getManager()
    {
        return Storage::get(\app\common\constant\Manager::CONTAINER_MANAGER);
    }

    /**
     * 获取权限
     * @return mixed|null
     */
    public static function getPermission()
    {
        return Storage::get(\app\common\constant\Manager::CONTAINER_PERMISSION);
    }

    /**
     * 检测是否为超级管理员
     * @return bool
     */
    public static function isSuper()
    {
        return static::getRoleName() == 'super';
    }

    /**
     * 检测账号是否被禁用
     * @return bool
     */
    public static function isDisabled()
    {
        return static::getManager()['status'] == \app\common\constant\Manager::STATUS_DISABLED;
    }

    /**
     * 通过菜单ID检测访问权限
     * @param $menuId
     * @param string $condition
     * @return bool
     */
    public static function checkAccessByMenuId($menuId, $condition = 'and')
    {
        $menuId     = !empty($menuId) ? explode(',', $menuId) : [];
        $permission = static::getPermission();

        return \app\common\helper\Permission::checkPermission($menuId, $permission, $condition);
    }

}