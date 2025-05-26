<?php


namespace app\admin\controller;


use Exception;

use think\Request;

use app\admin\service\SystemDictTypeService;
use app\admin\validate\SystemDictTypeValidate;
use app\admin\dependency\SystemDictTypeDependency;

use app\common\controller\SystemController;

class SystemDictTypeController extends SystemController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['System'];

    /**
     * 服务类
     * @var SystemDictTypeService
     */
    protected $SystemDictTypeService;

    /**
     * 验证器
     * @var SystemDictTypeValidate
     */
    protected $SystemDictTypeValidate;

    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemDictTypeService  = SystemDictTypeDependency::getService();
        $this->SystemDictTypeValidate = SystemDictTypeDependency::getValidate();
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

            $this->success('获取成功', '', $this->SystemDictTypeService->listSystemDictType($params));
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
                'name'     => $request->post('name'),
                'identify' => $request->post('identify'),
                'status'   => $request->post('status'),
                'remark'   => $request->post('remark'),
                'sort'     => $request->post('sort'),
            ];

            $this->SystemDictTypeValidate->scene('create')->verify($params);
            $this->SystemDictTypeService->createSystemDictType($params);

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
                'dictId'   => $request->post('dictId'),
                'name'     => $request->post('name'),
                'identify' => $request->post('identify'),
                'status'   => $request->post('status'),
                'remark'   => $request->post('remark'),
                'sort'     => $request->post('sort'),
            ];

            $this->SystemDictTypeValidate->scene('update')->verify($params);
            $this->SystemDictTypeService->updateSystemDictType($params);

            $this->success('修改成功');
        }

        $dict = $this->SystemDictTypeService->getBySystemDictTypeId($request->get('dictId'));

        return $this->fetch('', [
            'dict' => $dict
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

            $this->SystemDictTypeValidate->scene('delete')->verify($params);
            $this->SystemDictTypeService->deleteSystemDictType($params);

            $this->success('删除成功');
        }
    }
}