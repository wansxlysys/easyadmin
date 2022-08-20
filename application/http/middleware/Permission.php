<?php


namespace app\http\middleware;

use helper\Register;
use traits\controller\Jump;
use app\admin\helper\Manager;

class Permission
{
    /**
     * 跳转操作
     */
    use Jump;

    /**
     * 管理员助手类
     * @var Manager
     */
    protected $ManagerHelper;

    /**
     * 初始化
     */
    public function __construct()
    {
        $this->ManagerHelper = new Manager();
    }

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

        Register::set(Manager::ROLE, $role);
        Register::set(Manager::MANAGER, $manager);
        Register::set(Manager::PERMISSION, $permission);
    }

    /**
     * 检测账号是否被禁用
     */
    public function checkDisabled()
    {
        if ($this->ManagerHelper->isDisabled()) {
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

        if (!$this->ManagerHelper->checkAccessByMenuId($currentMenu['id'])) {
            $this->error('您的账号未授权访问');
        }
    }

    /**
     * 登录校验
     */
    public function checkLogin()
    {
        if (!$this->ManagerHelper->isLogin()) {
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

        return $ManagerService->getById($this->ManagerHelper->getManagerId());
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