<?php


namespace app\common\middleware;


use Closure;
use Exception;

use think\Request;
use think\facade\Hook;
use traits\controller\Jump;

use app\admin\helper\SystemMenuHelper;
use app\admin\helper\SystemManagerHelper;
use app\admin\behavior\SystemLogBehavior;

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
        $this->checkDeleted();
        $this->checkDisabled();
        $this->addAppEndHook();

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
        if (SystemMenuHelper::getMenu()) {
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
        if (SystemManagerHelper::checkAccessByMenuIds(SystemMenuHelper::getMenu()['menuId'])) {
            return true;
        }

        $this->error('账号未授权访问');
    }

    /**
     * 检测是否失效
     * @return bool|void
     * @throws Exception
     */
    public function checkValid()
    {
        if (SystemManagerHelper::verifyPassword()) {
            return true;
        }

        SystemManagerHelper::logout();

        $this->error('登录失效', 'admin/SystemLogin/login');
    }

    /**
     * 检测账号是否被禁用
     * @return bool|void
     * @throws Exception
     */
    public function checkDeleted()
    {
        if (!SystemManagerHelper::isDeleted()) {
            return true;
        }

        SystemManagerHelper::logout();

        $this->error('账号已删除', 'admin/SystemLogin/login');
    }

    /**
     * 检测账号是否被禁用
     * @throws Exception
     */
    public function checkDisabled()
    {
        if (!SystemManagerHelper::isDisabled()) {
            return true;
        }

        SystemManagerHelper::logout();

        $this->error('账号被禁用', 'admin/SystemLogin/login');
    }

    /**
     * 添加请求结束钩子
     * @return void
     */
    public function addAppEndHook()
    {
        if (request()->isAjax()) {
            Hook::add('app_end', SystemLogBehavior::class);
        }
    }
}