<?php


namespace app\http\middleware;


use Closure;
use Exception;

use think\Request;
use traits\controller\Jump;

use app\admin\helper\SystemManagerHelper;
use app\admin\helper\SystemMenuHelper;

class SystemMiddleware
{
    /**
     * 跳转操作
     */
    use Jump;

    /**
     * 句柄
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle(Request $request, Closure $next)
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
        if (SystemManagerHelper::isLogin()) {
            return true;
        }

        $this->error('未登录', 'admin/SystemLogin/login');
    }

    /**
     * 检测菜单
     * @throws Exception
     */
    public function checkMenu()
    {
        $currentMenu = SystemMenuHelper::getCurrentMenu();

        if ($currentMenu) {
            return true;
        }

        $this->error('系统菜单不存在');
    }

    /**
     * 权限校验
     * @throws Exception
     */
    public function checkAuth()
    {
        $currentMenu = SystemMenuHelper::getCurrentMenu();

        if (SystemManagerHelper::checkAccessByMenuId($currentMenu['menuId'])) {
            return true;
        }

        $this->error('账号未授权访问');
    }

    /**
     * 检测是否失效
     * @return bool|void
     */
    public function checkValid()
    {
        $manager = SystemManagerHelper::getManager();

        if (SystemManagerHelper::verify($manager['account'], $manager['password'])) {
            return true;
        }

        SystemManagerHelper::logout();

        $this->error('登录失效', 'admin/SystemLogin/login');
    }

    /**
     * 检测账号是否被禁用
     * @return bool|void
     */
    public function checkDelete()
    {
        if (!SystemManagerHelper::isDelete()) {
            return true;
        }

        SystemManagerHelper::logout();

        $this->error('账号已删除', 'admin/SystemLogin/login');
    }

    /**
     * 检测账号是否被禁用
     */
    public function checkDisabled()
    {
        if (SystemManagerHelper::isEnabled()) {
            return true;
        }

        $this->error('账号被禁用');
    }
}