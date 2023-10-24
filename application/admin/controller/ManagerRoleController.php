<?php


namespace app\admin\controller;


use think\Request;
use app\admin\service\PermissionService;
use app\admin\service\ManagerRoleService;
use app\admin\validate\ManagerRoleValidate;

class ManagerRoleController extends \app\common\controller\AdminController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['Permission'];

    /**
     * 服务类
     * @var ManagerRoleService
     */
    protected $ManagerRoleService;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->ManagerRoleService = new ManagerRoleService();
    }

    /**
     * 首页
     * @param Request $request
     * @return mixed
     */
    public function index_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'page'  => $request->get('page'),
                'limit' => $request->get('limit'),
                'name'  => $request->get('name'),
            ];

            $this->success('获取成功', '', $this->ManagerRoleService->getListWithTotal($params));
        }
        return $this->fetch();
    }

    /**
     * 添加
     * @param Request $request
     * @return mixed
     */
    public function create_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'name'       => $request->post('name'),
                'identify'   => $request->post('identify'),
                'remark'     => $request->post('remark'),
                'permission' => $request->post('permission'),
            ];

            $RoleValidate = new ManagerRoleValidate();

            if (!$RoleValidate->scene('Create')->check($params)) {
                $this->error($RoleValidate->getError());
            }

            if (!$this->ManagerRoleService->createRole($params)) {
                $this->error('添加失败');
            }

            $this->success('添加成功');
        }

        return $this->fetch();
    }

    /**
     * 修改
     * @param Request $request
     * @return mixed
     */
    public function update_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id'         => $request->post('id'),
                'name'       => $request->post('name'),
                'identify'   => $request->post('identify'),
                'remark'     => $request->post('remark'),
                'permission' => $request->post('permission'),
            ];

            $RoleValidate = new ManagerRoleValidate();

            if (!$RoleValidate->scene('Update')->check($params)) {
                $this->error($RoleValidate->getError());
            }

            if (!$this->ManagerRoleService->updateRole($params)) {
                $this->error($this->ManagerRoleService->getMessage());
            }

            $this->success('修改成功');
        }

        $PermissionService = new PermissionService();

        $role       = $this->ManagerRoleService->getById($request->get('id'));
        $permission = $PermissionService->getAllMenuIdByRoleId($role['id']);

        return $this->fetch('', [
            'role'       => $role,
            'permission' => $permission
        ]);
    }

    /**
     * 删除
     * @param Request $request
     */
    public function delete_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id' => $request->post('id')
            ];

            $RoleValidate = new ManagerRoleValidate();

            if (!$RoleValidate->scene('Delete')->check($params)) {
                $this->error($RoleValidate->getError());
            }

            $result = $this->ManagerRoleService->deleteRole($params);

            if (!$result) {
                $this->error($this->ManagerRoleService->getMessage());
            }

            $this->success('删除成功');
        }
    }

    /**
     * 全部
     * @param Request $request
     */
    public function get_all_action(Request $request)
    {
        if ($request->isAjax()) {
            $this->success('获取成功', '', $this->ManagerRoleService->getAll());
        }
    }
}