<?php


namespace app\http\middleware;


use Closure;
use Throwable;

use traits\controller\Jump;

use app\common\helper\ManagerHelper;
use app\common\helper\SystemMenuHelper;

class System
{
    /**
     * 跳转操作
     */
    use Jump;

    /**
     * 句柄
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws Throwable
     */
    public function handle($request, Closure $next)
    {
        $this->checkLogin();
        $this->checkMenu();
        $this->checkAuth();
        $this->checkValid();
        $this->checkDelete();
        $this->checkDisabled();

        return $next($request);
    }

    /**
     * 登录校验
     */
    public function checkLogin()
    {
        if (!ManagerHelper::isLogin()) {
            $this->error('未登录', 'admin/login/login');
        }
    }

    /**
     * 检测菜单
     * @throws Throwable
     */
    public function checkMenu()
    {
        $currentMenu = SystemMenuHelper::getCurrentMenu();

        if (!$currentMenu) {
            $this->error('系统菜单不存在');
        }
    }

    /**
     * 权限校验
     * @throws Throwable
     */
    public function checkAuth()
    {
        $currentMenu = SystemMenuHelper::getCurrentMenu();

        if (!ManagerHelper::checkAccessByMenuId($currentMenu['id'])) {
            $this->error('账号未授权访问');
        }
    }

    /**
     * 检测是否失效
     * @return bool|void
     */
    public function checkValid()
    {
        $manager = ManagerHelper::getManager();

        if (ManagerHelper::verify($manager['account'], $manager['password'])) {
            return true;
        }

        ManagerHelper::logout();

        $this->error('登录失效', 'admin/login/login');
    }

    /**
     * 检测账号是否被禁用
     * @return bool|void
     */
    public function checkDelete()
    {
        if (!ManagerHelper::isDelete()) {
            return true;
        }

        ManagerHelper::logout();

        $this->error('账号已删除', 'admin/login/login');
    }

    /**
     * 检测账号是否被禁用
     */
    public function checkDisabled()
    {
        if (ManagerHelper::isDisabled()) {
            $this->error('账号被禁用');
        }
    }
}