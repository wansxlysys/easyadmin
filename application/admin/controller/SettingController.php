<?php


namespace app\admin\controller;


use think\Request;
use app\admin\service\SettingSystemService;
use app\admin\validate\SettingSystemValidate;

class SettingController extends \app\common\controller\Admin
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['Permission'];

    /**
     * 系统设置服务类
     * @var SettingSystemService
     */
    protected $SettingSystemService;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->SettingSystemService = new SettingSystemService();
    }

    /**
     * 系统配置
     * @param Request $request
     * @return mixed
     */
    public function system_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'name'   => $request->post('name'),
                'slogan' => $request->post('slogan'),
            ];

            $SettingSystemValidate = new SettingSystemValidate();

            if (!$SettingSystemValidate->scene('System')->check($params)) {
                $this->error($SettingSystemValidate->getError());
            }

            $result = $this->SettingSystemService->setSetting($params);

            if (!$result) {
                $this->error('修改失败');
            }

            $this->success('修改成功');
        }

        $setting = $this->SettingSystemService->getSetting();

        return $this->fetch('', [
            'setting' => $setting
        ]);
    }
}