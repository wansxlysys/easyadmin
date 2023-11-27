<?php


namespace app\admin\controller;


use think\Request;
use think\captcha\Captcha;
use app\common\helper\ManagerHelper;
use app\admin\service\ManagerService;
use app\admin\validate\ManagerValidate;
use app\common\exception\SystemException;
use app\admin\service\SystemSettingService;

class LoginController extends \app\common\controller\CommonController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        if (ManagerHelper::isLogin()) {
            $this->redirect('admin/Index/index');
        }
    }

    /**
     * 登录
     * @param Request $request
     * @return mixed
     * @throws SystemException
     */
    public function login_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'account'  => $request->post('account'),
                'password' => $request->post('password'),
                'captcha'  => $request->post('captcha'),
            ];

            $ManagerValidate = new ManagerValidate();

            if (!$ManagerValidate->scene('Login')->check($params)) {
                $this->error($ManagerValidate->getError());
            }

            $ManagerService = new ManagerService();

            if (!$ManagerService->login($params)) {
                $this->error($ManagerService->getMessage());
            }

            $this->success('登录成功', 'admin/Index/index');
        }

        $SettingSystem = new SystemSettingService();

        return $this->fetch('', [
            'settingSystem' => $SettingSystem->getSetting()
        ]);
    }

    /**
     * 验证码
     * @return mixed
     */
    public function captcha_action()
    {
        $captcha = new Captcha([
            'length'  => 4,
            'fontttf' => '4.ttf',
            'codeSet' => '0123456789'
        ]);

        return $captcha->entry('login');
    }
}