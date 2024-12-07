<?php


namespace app\admin\controller;


use Exception;

use think\Request;

use app\admin\service\SystemSettingService;
use app\admin\validate\SystemSettingValidate;
use app\admin\dependency\SystemSettingDependency;

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
        $this->SystemSettingService  = SystemSettingDependency::getService();
        $this->SystemSettingValidate = SystemSettingDependency::getValidate();
    }

    /**
     * 系统设置
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function configAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'content' => $request->post('content'),
            ];

            $this->SystemSettingValidate->scene('Config')->verify($params);
            $this->SystemSettingService->setSystemSetting($params);

            $this->success('修改成功');
        }

        $setting = $this->SystemSettingService->getSystemSetting();

        return $this->fetch('', [
            'setting' => $setting
        ]);
    }

    /**
     * 全局设置
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function systemAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'name'   => $request->post('name'),
                'slogan' => $request->post('slogan'),
            ];

            $this->SystemSettingValidate->scene('System')->verify($params);
            $this->SystemSettingService->setSystemSetting($params);

            $this->success('修改成功');
        }

        $setting = $this->SystemSettingService->getSystemSetting();

        return $this->fetch('', [
            'setting' => $setting
        ]);
    }
}