<?php


namespace app\http\middleware;


use Closure;
use traits\controller\Jump;
use app\common\enum\ManagerEnum;
use app\admin\service\MenuService;
use app\common\helper\StorageHelper;
use app\common\helper\ManagerHelper;
use app\admin\service\ManagerService;
use app\admin\service\PermissionService;
use app\admin\service\ManagerRoleService;

class Permission
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
        $this->initialize();
        $this->checkAuth();
        $this->checkDisabled();

        return $next($request);
    }

    /**
     * 注册变量
     */
    public function initialize()
    {
        $manager    = $this->getManager();
        $role       = $this->getRole($manager['role_id']);
        $permission = $this->getPermission($manager['role_id']);

        StorageHelper::set(ManagerEnum::CONTAINER_ROLE, $role);
        StorageHelper::set(ManagerEnum::CONTAINER_MANAGER, $manager);
        StorageHelper::set(ManagerEnum::CONTAINER_PERMISSION, $permission);
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

    /**
     * 权限校验
     */
    public function checkAuth()
    {
        $MenuService = new MenuService();
        $currentMenu = $MenuService->getCurrentMenu();

        if (!ManagerHelper::checkAccessByMenuId($currentMenu['id'])) {
            $this->error('您的账号未授权访问');
        }
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
     * 获取管理员信息
     * @return mixed
     */
    protected function getManager()
    {
        $ManagerService = new ManagerService();

        return $ManagerService->getById(ManagerHelper::getManagerId());
    }

    /**
     * 获取角色信息
     * @param $roleId
     * @return mixed
     */
    protected function getRole($roleId)
    {
        $RoleService = new ManagerRoleService();

        return $RoleService->getById($roleId);
    }

    /**
     * 获取权限
     * @param $roleId
     * @return mixed
     */
    protected function getPermission($roleId)
    {
        $PermissionService = new PermissionService();

        return $PermissionService->getAllMenuIdByRoleId($roleId);
    }
}