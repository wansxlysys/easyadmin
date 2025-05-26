<?php


namespace app\admin\controller;


use Exception;

use think\Request;

use app\admin\service\SystemDictDataService;
use app\admin\validate\SystemDictDataValidate;
use app\admin\dependency\SystemDictDataDependency;

use app\common\controller\SystemController;

class SystemDictDataController extends SystemController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['System'];

    /**
     * 服务类
     * @var SystemDictDataService
     */
    protected $SystemDictDataService;

    /**
     * 验证器
     * @var SystemDictDataValidate
     */
    protected $SystemDictDataValidate;

    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemDictDataService  = SystemDictDataDependency::getService();
        $this->SystemDictDataValidate = SystemDictDataDependency::getValidate();
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

            $this->success('获取成功', '', $this->SystemDictDataService->listSystemDictData($params));
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
                'name' => $request->post('name'),
            ];

            $this->SystemDictDataValidate->scene('create')->verify($params);
            $this->SystemDictDataService->createSystemDictData($params);

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
                'id'   => $request->post('id'),
                'name' => $request->post('name'),
            ];

            $this->SystemDictDataValidate->scene('update')->verify($params);
            $this->SystemDictDataService->updateSystemDictData($params);

            $this->success('修改成功');
        }

        $role = $this->SystemDictDataService->getBySystemDictDataId($request->get('id'));

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
                'id' => $request->post('id')
            ];

            $this->SystemDictDataValidate->scene('delete')->verify($params);
            $this->SystemDictDataService->deleteSystemDictData($params);

            $this->success('删除成功');
        }
    }
}