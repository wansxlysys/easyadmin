<?php


namespace app\http\middleware;


use traits\controller\Jump;
use app\common\helper\Storage;

class Permission
{
    /**
     * 跳转操作
     */
    use Jump;

    /**
     * 句柄
     * @param $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
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

        Storage::set(\app\common\constant\Manager::CONTAINER_ROLE, $role);
        Storage::set(\app\common\constant\Manager::CONTAINER_MANAGER, $manager);
        Storage::set(\app\common\constant\Manager::CONTAINER_PERMISSION, $permission);
    }

    /**
     * 检测账号是否被禁用
     */
    public function checkDisabled()
    {
        if (\app\common\helper\Manager::isDisabled()) {
            $this->error('账号被禁用');
        }
    }

    /**
     * 权限校验
     */
    public function checkAuth()
    {
        $MenuService = new \app\admin\service\Menu();
        $currentMenu = $MenuService->getCurrentMenu();

        if (!\app\common\helper\Manager::checkAccessByMenuId($currentMenu['id'])) {
            $this->error('您的账号未授权访问');
        }
    }

    /**
     * 登录校验
     */
    public function checkLogin()
    {
        if (!\app\common\helper\Manager::isLogin()) {
            $this->error('未登录', 'admin/login/login');
        }
    }

    /**
     * 获取管理员信息
     * @return mixed
     */
    protected function getManager()
    {
        $ManagerService = new \app\admin\service\Manager();

        return $ManagerService->getById(\app\common\helper\Manager::getManagerId());
    }

    /**
     * 获取角色信息
     * @param $roleId
     * @return mixed
     */
    protected function getRole($roleId)
    {
        $RoleService = new \app\admin\service\Role();

        return $RoleService->getById($roleId);
    }

    /**
     * 获取权限
     * @param $roleId
     * @return mixed
     */
    protected function getPermission($roleId)
    {
        $PermissionService = new \app\admin\service\Permission();

        return $PermissionService->getAllMenuIdByRoleId($roleId);
    }
}