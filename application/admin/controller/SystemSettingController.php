<?php


namespace app\admin\controller;


use Exception;

use think\Request;

use app\admin\service\SystemSettingService;
use app\admin\validate\SystemSettingValidate;

use app\common\dependency\Dependency;
use app\common\controller\SystemController;

class SystemSettingController extends SystemController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['SystemMiddleware'];

    /**
     * 服务类
     * @var SystemSettingService
     */
    protected $SystemSettingService;

    /**
     * 验证类
     * @var SystemSettingValidate
     */
    protected $SystemSettingValidate;

    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemSettingService  = Dependency::getProxy(SystemSettingService::class);
        $this->SystemSettingValidate = Dependency::getProxy(SystemSettingValidate::class);
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
                'page'     => $request->get('page'),
                'limit'    => $request->get('limit'),
                'type'     => $request->get('type'),
                'name'     => $request->get('name'),
                'identify' => $request->get('identify'),
            ];

            $this->success('获取成功', '', $this->SystemSettingService->getPageSetting($params));
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
                'type'     => $request->post('type'),
                'name'     => $request->post('name'),
                'identify' => $request->post('identify'),
                'value'    => $request->post('value'),
                'remark'   => $request->post('remark'),
                'sort'     => $request->post('sort'),
            ];

            $this->SystemSettingValidate->scene('create')->verify($params);
            $this->SystemSettingService->createSetting($params);

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
                'settingId' => $request->post('settingId'),
                'type'      => $request->post('type'),
                'name'      => $request->post('name'),
                'identify'  => $request->post('identify'),
                'value'     => $request->post('value'),
                'remark'    => $request->post('remark'),
                'sort'      => $request->post('sort'),
            ];

            $this->SystemSettingValidate->scene('update')->verify($params);
            $this->SystemSettingService->updateSetting($params);

            $this->success('修改成功');
        }

        $setting = $this->SystemSettingService->getSettingById($request->get('settingId'));

        return $this->fetch('', [
            'setting' => $setting
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
                'settingId' => $request->post('settingId')
            ];

            $this->SystemSettingValidate->scene('delete')->verify($params);
            $this->SystemSettingService->deleteSetting($params);

            $this->success('删除成功');
        }
    }
}