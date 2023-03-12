<?php


namespace app\admin\controller;


use think\Request;

class Login extends \app\common\controller\Common
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();

        if (\app\common\helper\Manager::isLogin()) {
            $this->redirect('admin/Index/index');
        }
    }

    /**
     * 登录
     * @param Request $request
     * @return mixed
     */
    public function login_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'account' => $request->post('account'),
                'password' => $request->post('password'),
                'captcha'  => $request->post('captcha'),
            ];

            $ManagerValidate = new \app\admin\validate\Manager();

            if (!$ManagerValidate->scene('login')->check($params)) {
                $this->error($ManagerValidate->getError());
            }

            $ManagerService = new \app\admin\service\Manager();

            if (!$ManagerService->login($params)) {
                $this->error($ManagerService->getMessage());
            }

            $this->success('登录成功', 'admin/Index/index');
        }

        $SettingSystem = new \app\admin\service\SettingSystem();

        return $this->fetch('', [
            'settingSystem' => $SettingSystem->getSetting()
        ]);
    }

    /**
     * 登录验证码
     * @return mixed
     */
    public function captcha_action()
    {
        $captcha = new \think\captcha\Captcha([
            'length'  => 4,
            'fontttf' => '4.ttf',
            'codeSet' => '0123456789'
        ]);

        return $captcha->entry('login');
    }
}