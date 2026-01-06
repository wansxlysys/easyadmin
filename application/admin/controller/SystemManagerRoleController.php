<?php


namespace app\admin\controller;


use Exception;

use think\Request;

use app\admin\service\SystemManagerRoleService;
use app\admin\validate\SystemManagerRoleValidate;

use app\common\controller\SystemController;

class SystemManagerRoleController extends SystemController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['SystemMiddleware'];

    /**
     * 服务类
     * @var SystemManagerRoleService
     */
    protected SystemManagerRoleService $SystemManagerRoleService;

    /**
     * 验证器
     * @var SystemManagerRoleValidate
     */
    protected SystemManagerRoleValidate $SystemManagerRoleValidate;

    /**
     * 首页
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function indexAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'page'     => $request->get('page'),
                'limit'    => $request->get('limit'),
                'name'     => $request->get('name'),
                'identify' => $request->get('identify'),
            ];

            $this->success('获取成功', '', $this->SystemManagerRoleService->getPageRole($params));
        }

        return $this->fetch();
    }

    /**
     * 添加
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function createAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'name'       => $request->post('name'),
                'identify'   => $request->post('identify'),
                'remark'     => $request->post('remark'),
                'permission' => $request->post('permission'),
                'sort'       => $request->post('sort'),
            ];

            $this->SystemManagerRoleValidate->scene('create')->verify($params);
            $this->SystemManagerRoleService->createRole($params);

            $this->success('添加成功');
        }

        return $this->fetch();
    }

    /**
     * 修改
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function updateAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'roleId'     => $request->post('roleId'),
                'name'       => $request->post('name'),
                'identify'   => $request->post('identify'),
                'remark'     => $request->post('remark'),
                'permission' => $request->post('permission'),
                'sort'       => $request->post('sort'),
            ];

            $this->SystemManagerRoleValidate->scene('update')->verify($params);
            $this->SystemManagerRoleService->updateRole($params);

            $this->success('修改成功');
        }

        $role = $this->SystemManagerRoleService->getRoleById($request->get('roleId'));

        return $this->fetch('', [
            'role' => $role
        ]);
    }

    /**
     * 删除
     * @param Request $request
     * @throws Exception
     */
    public function deleteAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'roleId' => $request->post('roleId')
            ];

            $this->SystemManagerRoleValidate->scene('delete')->verify($params);
            $this->SystemManagerRoleService->deleteRole($params);

            $this->success('删除成功');
        }
    }

    /**
     * 全部
     * @param Request $request
     * @throws Exception
     */
    public function getAllAction(Request $request)
    {
        if ($request->isAjax()) {
            $this->success('获取成功', '', $this->SystemManagerRoleService->getAll());
        }
    }
}