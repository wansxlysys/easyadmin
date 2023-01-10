<?php


namespace app\admin\helper;


use helper\Container;
use think\facade\Session;

class Manager extends \app\common\helper\Permission
{
    /**
     * 角色标识
     */
    const ROLE = 'ROLE';

    /**
     * 管理员标识
     */
    const MANAGER = 'MANAGER';

    /**
     * 管理员登录标识
     */
    const MANAGER_ID = 'MANAGER_ID';

    /**
     * 权限标识
     */
    const PERMISSION = 'PERMISSION';

    /**
     * 设置登录信息
     * @param $managerId
     */
    public function login($managerId)
    {
        Session::set(self::MANAGER_ID, $managerId);
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        Session::delete(self::MANAGER_ID);
    }

    /**
     * 获取登录管理ID
     * @return mixed
     */
    public function getManagerId()
    {
        return Session::get(self::MANAGER_ID);
    }

    /**
     * 检测用户是否登录
     * @return bool
     */
    public function isLogin()
    {
        return Session::has(self::MANAGER_ID);
    }

    /**
     * 获取角色
     * @return mixed|null
     */
    public function getRole()
    {
        return Container::get(self::ROLE);
    }

    /**
     * 获取角色名称
     * @return mixed
     */
    public function getRoleName()
    {
        return $this->getRole()['name'];
    }

    /**
     * 获取管理员
     * @return mixed|null
     */
    public function getManager()
    {
        return Container::get(self::MANAGER);
    }

    /**
     * 获取权限
     * @return mixed|null
     */
    public function getPermission()
    {
        return Container::get(self::PERMISSION);
    }

    /**
     * 检测是否为超级管理员
     * @return bool
     */
    public function isSuper()
    {
        return $this->getRoleName() == 'super';
    }

    /**
     * 检测账号是否被禁用
     * @return bool
     */
    public function isDisabled()
    {
        return $this->getManager()['status'] == \app\admin\service\Manager::STATUS_DISABLED;
    }

    /**
     * 通过菜单ID检测访问权限
     * @param $menuId
     * @param string $condition
     * @return bool
     */
    public function checkAccessByMenuId($menuId, $condition = 'and')
    {
        $menuId     = !empty($menuId) ? explode(',', $menuId) : [];
        $permission = $this->getPermission();

        return $this->checkPermission($menuId, $permission, $condition);
    }

}