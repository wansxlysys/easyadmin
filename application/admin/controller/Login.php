<?php


namespace app\admin\controller;

use think\Request;

class Login extends \app\common\controller\Common
{
    /**
     * 登录
     * @param Request $request
     * @return mixed
     */
    public function login_action(Request $request)
    {
        if ($request->isPost()) {
            $params = [
                'username' => $request->post('username'),
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

            $this->success('登录成功', 'admin/index/index');
        }

        $SettingSystem = new \app\admin\service\SettingSystem();

        $settingSystem = $SettingSystem->getSetting();

        return $this->fetch('', [
            'settingSystem' => $settingSystem
        ]);
    }

    /**
     * 登录验证码
     * @return \think\Response
     */
    public function captcha_action()
    {
        $captcha = new \think\captcha\Captcha([
            'codeSet' => '0123456789',
            'length'  => 4,
        ]);
        return $captcha->entry('login');
    }
}