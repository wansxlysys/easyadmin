<?php


namespace app\admin\controller;


use think\Request;
use app\common\exception\SystemException;
use app\admin\service\SystemSettingService;
use app\admin\validate\SystemSettingValidate;

class SystemSettingController extends \app\common\controller\AdminController
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
     * @throws SystemException
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
     * @throws SystemException
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
     * @throws SystemException
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