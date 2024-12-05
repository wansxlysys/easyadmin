<?php


namespace app\admin\controller;


use Exception;

use think\Request;
use think\Response;
use think\captcha\Captcha;

use app\admin\service\ManagerService;
use app\admin\service\SystemSettingService;
use app\admin\validate\ManagerValidate;

use app\common\helper\ManagerHelper;
use app\common\controller\CommonController;

class LoginController extends CommonController
{
    /**
     * 服务类
     * @var ManagerService
     */
    protected $ManagerService;

    /**
     * 验证器
     * @var ManagerValidate
     */
    protected $ManagerValidate;

    /**
     * 初始化
     */
    public function initialize()
    {
        if (ManagerHelper::isLogin()) {
            $this->redirect('admin/Index/index');
        }

        $this->ManagerService  = new ManagerService();
        $this->ManagerValidate = new ManagerValidate();
    }

    /**
     * 登录
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function loginAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'loginIp'  => $request->ip(),
                'account'  => $request->post('account'),
                'password' => $request->post('password'),
                'captcha'  => $request->post('captcha'),
            ];

            $this->ManagerValidate->scene('Login')->verify($params);
            $this->ManagerService->login($params);

            $this->success('登录成功', 'admin/Index/index');
        }

        $systemSetting = new SystemSettingService();

        return $this->fetch('', [
            'systemSetting' => $systemSetting->getSystemSetting()
        ]);
    }

    /**
     * 验证码
     * @return Response
     */
    public function captchaAction()
    {
        $captcha = new Captcha([
            'length'  => 4,
            'fontttf' => '4.ttf',
            'codeSet' => '0123456789'
        ]);

        return $captcha->entry('login');
    }
}