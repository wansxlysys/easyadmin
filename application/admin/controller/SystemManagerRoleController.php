<?php


namespace app\admin\controller;


use Exception;

use think\Request;

use app\admin\service\SystemManagerRoleService;
use app\admin\validate\SystemManagerRoleValidate;
use app\admin\dependency\SystemManagerRoleDependency;

use app\common\controller\SystemController;

class SystemManagerRoleController extends SystemController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['System'];

    /**
     * 服务类
     * @var SystemManagerRoleService
     */
    protected $ManagerRoleService;

    /**
     * 验证器
     * @var SystemManagerRoleValidate
     */
    protected $ManagerRoleValidate;

    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->ManagerRoleService  = SystemManagerRoleDependency::getService();
        $this->ManagerRoleValidate = SystemManagerRoleDependency::getValidate();
    }

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
                'page'  => $request->get('page'),
                'limit' => $request->get('limit'),
                'name'  => $request->get('name'),
            ];

            $this->success('获取成功', '', $this->ManagerRoleService->listRole($params));
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
                'remark'     => $request->post('remark'),
                'identify'   => $request->post('identify'),
                'permission' => $request->post('permission'),
            ];

            $this->ManagerRoleValidate->scene('create')->verify($params);
            $this->ManagerRoleService->createRole($params);

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
            ];

            $this->ManagerRoleValidate->scene('update')->verify($params);
            $this->ManagerRoleService->updateRole($params);

            $this->success('修改成功');
        }

        $role = $this->ManagerRoleService->getRoleById($request->get('roleId'));

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

            $this->ManagerRoleValidate->scene('delete')->verify($params);
            $this->ManagerRoleService->deleteRole($params);

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
            $this->success('获取成功', '', $this->ManagerRoleService->getAll());
        }
    }
}