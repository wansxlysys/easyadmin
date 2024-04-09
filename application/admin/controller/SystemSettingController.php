<?php


namespace app\admin\controller;


use Throwable;

use think\Request;

use app\admin\service\SystemSettingService;
use app\admin\validate\SystemSettingValidate;

use app\common\controller\AdminController;

class SystemSettingController extends AdminController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['System'];

    /**
     * 服务类
     * @var SystemSettingService
     */
    protected $SystemSettingService;

    /**
     * 初始化
     * @throws Throwable
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemSettingService = new SystemSettingService();
    }

    /**
     * 系统设置
     * @param Request $request
     * @return mixed
     * @throws Throwable
     */
    public function config_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'content' => $request->post('content'),
            ];

            $SystemSettingValidate = new SystemSettingValidate();

            if (!$SystemSettingValidate->scene('Config')->check($params)) {
                $this->error($SystemSettingValidate->getError());
            }

            $result = $this->SystemSettingService->setSetting($params);

            if (!$result) {
                $this->error('修改失败');
            }

            $this->success('修改成功');
        }

        $setting = $this->SystemSettingService->getSetting();

        return $this->fetch('', [
            'setting' => $setting
        ]);
    }

    /**
     * 全局设置
     * @param Request $request
     * @return mixed
     * @throws Throwable
     */
    public function system_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'name'   => $request->post('name'),
                'slogan' => $request->post('slogan'),
            ];

            $SystemSettingValidate = new SystemSettingValidate();

            if (!$SystemSettingValidate->scene('System')->check($params)) {
                $this->error($SystemSettingValidate->getError());
            }

            $result = $this->SystemSettingService->setSetting($params);

            if (!$result) {
                $this->error('修改失败');
            }

            $this->success('修改成功');
        }

        $setting = $this->SystemSettingService->getSetting();

        return $this->fetch('', [
            'setting' => $setting
        ]);
    }
}