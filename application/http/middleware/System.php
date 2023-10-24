<?php


namespace app\http\middleware;


use Closure;
use traits\controller\Jump;
use app\common\enum\ManagerEnum;
use app\common\helper\StorageHelper;
use app\common\helper\ManagerHelper;
use app\admin\service\ManagerService;
use app\admin\service\SystemMenuService;
use app\admin\service\ManagerRoleService;

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
     */
    public function handle($request, Closure $next)
    {
        $this->checkLogin();
        $this->checkData();
        $this->checkAuth();
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
     * 注册变量
     */
    public function checkData()
    {
        $ManagerService     = new ManagerService();
        $ManagerRoleService = new ManagerRoleService();

        $manager     = $ManagerService->getById(ManagerHelper::getManagerId());
        $managerRole = $ManagerRoleService->getRole($manager['role_id']);

        StorageHelper::set(ManagerEnum::CONTAINER_MANAGER, $manager);
        StorageHelper::set(ManagerEnum::CONTAINER_MANAGER_ROLE, $managerRole);
    }

    /**
     * 权限校验
     */
    public function checkAuth()
    {
        $MenuService = new SystemMenuService();
        $currentMenu = $MenuService->getCurrentMenu();

        if (!ManagerHelper::checkAccessByMenuId($currentMenu['id'])) {
            $this->error('您的账号未授权访问');
        }
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