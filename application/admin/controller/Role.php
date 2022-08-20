<?php


namespace app\admin\controller;

use think\Request;

class Role extends \app\common\controller\Admin
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['Permission'];

    /**
     * 角色服务类
     * @var \app\admin\service\Role
     */
    protected $RoleService;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->RoleService = new \app\admin\service\Role();
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
                'title' => $request->get('title'),
            ];

            $this->success('获取成功', '', $this->RoleService->getListWithTotal($params));
        }
        return $this->fetch();
    }

    /**
     * 添加角色
     * @param Request $request
     * @return mixed
     */
    public function create_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'title'      => $request->post('title'),
                'name'       => $request->post('name'),
                'remark'     => $request->post('remark'),
                'permission' => $request->post('permission'),
            ];

            $RoleValidate = new \app\admin\validate\Role();

            if (!$RoleValidate->scene('create')->check($params)) {
                $this->error($RoleValidate->getError());
            }

            if (!$this->RoleService->createRecord($params)) {
                $this->error('添加失败');
            }

            $this->success('添加成功');
        }

        return $this->fetch();
    }

    /**
     * 修改角色
     * @param Request $request
     * @return mixed
     */
    public function update_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id'         => $request->post('id'),
                'title'      => $request->post('title'),
                'name'       => $request->post('name'),
                'remark'     => $request->post('remark'),
                'permission' => $request->post('permission'),
            ];

            $RoleValidate = new \app\admin\validate\Role();

            if (!$RoleValidate->scene('update')->check($params)) {
                $this->error($RoleValidate->getError());
            }

            if (!$this->RoleService->updateByParamsId($params)) {
                $this->error($this->RoleService->getMessage());
            }

            $this->success('修改成功');
        }

        $PermissionService = new \app\admin\service\Permission();

        $role       = $this->RoleService->getById($request->get('id'));
        $permission = $PermissionService->getAllMenuIdByRoleId($role['id']);

        return $this->fetch('', [
            'role'       => $role,
            'permission' => $permission
        ]);
    }

    /**
     * 删除角色
     * @param Request $request
     */
    public function delete_action(Request $request)
    {
        if ($request->isAjax()) {
            $params = [
                'id' => $request->post('id')
            ];

            $RoleValidate = new \app\admin\validate\Role();

            if (!$RoleValidate->scene('delete')->check($params)) {
                $this->error($RoleValidate->getError());
            }

            $result = $this->RoleService->deleteByParamsId($params['id']);

            if (!$result) {
                $this->error($this->RoleService->getMessage());
            }

            $this->success('删除成功');
        }
    }
}