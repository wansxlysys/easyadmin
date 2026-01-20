<?php


namespace app\admin\controller;


use Exception;

use think\Request;
use think\Response;
use think\captcha\Captcha;

use app\common\controller\CommonController;

use app\admin\helper\SystemManagerHelper;
use app\admin\service\SystemManagerService;
use app\admin\service\SystemDictDataService;
use app\admin\validate\SystemManagerValidate;

class SystemLoginController extends CommonController
{
    /**
     * 服务类
     * @var SystemManagerService
     */
    protected SystemManagerService $SystemManagerService;

    /**
     * 验证器
     * @var SystemManagerValidate
     */
    protected SystemManagerValidate $SystemManagerValidate;

    /**
     * 服务类
     * @var SystemDictDataService
     */
    protected SystemDictDataService $SystemDictDataService;

    /**
     * 初始化
     */
    public function initialize()
    {
        if (SystemManagerHelper::isLogin()) {
            $this->redirect('admin/SystemIndex/index');
        }
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

            $this->SystemManagerValidate->scene('login')->verify($params);
            $this->SystemManagerService->login($params);

            $this->success('登录成功', 'admin/SystemIndex/index');
        }

        return $this->fetch('', [
            'systemSetting' => $this->SystemDictDataService->getSystemGlobalSetting()
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