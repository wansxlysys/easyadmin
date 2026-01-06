<?php


namespace app\admin\controller;


use Exception;

use think\Request;

use app\admin\service\SystemDictDataService;
use app\admin\validate\SystemDictDataValidate;

use app\common\controller\SystemController;

class SystemDictDataController extends SystemController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['SystemMiddleware'];

    /**
     * 服务类
     * @var SystemDictDataService
     */
    protected SystemDictDataService $SystemDictDataService;

    /**
     * 验证器
     * @var SystemDictDataValidate
     */
    protected SystemDictDataValidate $SystemDictDataValidate;

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
                'page'   => $request->get('page'),
                'limit'  => $request->get('limit'),
                'label'  => $request->get('label'),
                'dictId' => $request->get('dictId'),
            ];

            $this->success('获取成功', '', $this->SystemDictDataService->getPageSystemDictData($params));
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
                'dictId'    => $request->post('dictId'),
                'label'     => $request->post('label'),
                'value'     => $request->post('value'),
                'style'     => $request->post('style'),
                'isDefault' => $request->post('isDefault'),
                'remark'    => $request->post('remark'),
                'status'    => $request->post('status'),
                'sort'      => $request->post('sort'),
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
                'dataId'    => $request->post('dataId'),
                'label'     => $request->post('label'),
                'value'     => $request->post('value'),
                'style'     => $request->post('style'),
                'isDefault' => $request->post('isDefault'),
                'remark'    => $request->post('remark'),
                'status'    => $request->post('status'),
                'sort'      => $request->post('sort'),
            ];

            $this->SystemDictDataValidate->scene('update')->verify($params);
            $this->SystemDictDataService->updateSystemDictData($params);

            $this->success('修改成功');
        }

        $dict = $this->SystemDictDataService->getBySystemDictDataId($request->get('dataId'));

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
                'dataId' => $request->post('dataId')
            ];

            $this->SystemDictDataValidate->scene('delete')->verify($params);
            $this->SystemDictDataService->deleteSystemDictData($params);

            $this->success('删除成功');
        }
    }
}