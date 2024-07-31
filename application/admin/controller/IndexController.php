<?php


namespace app\admin\controller;


use Exception;

use think\Request;

use app\admin\service\ManagerService;
use app\admin\validate\ManagerValidate;
use app\admin\service\SystemMenuService;

use app\common\helper\ManagerHelper;
use app\common\controller\AdminController;

class IndexController extends AdminController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['System'];

    /**
     * 验证器
     * @var ManagerService
     */
    protected $ManagerService;

    /**
     * 服务类
     * @var ManagerValidate
     */
    protected $ManagerValidate;

    /**
     * 首页
     * @return mixed
     * @throws Exception
     */
    public function index_action()
    {
        $SystemMenuService = new SystemMenuService();

        $menuTree = $SystemMenuService->getLeftMenu();

        return $this->fetch('', [
            'menuTree' => $menuTree
        ]);
    }

    /**
     * 个人资料
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function profile_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id'       => ManagerHelper::getManagerId(),
                'avatar'   => $request->post('avatar'),
                'realName' => $request->post('realName'),
                'password' => $request->post('password'),
            ];

            $this->ManagerValidate->scene('Profile')->verify($params);
            $this->ManagerService->updateManager($params);

            $this->success('修改成功');
        }

        $manager = ManagerHelper::getManager();

        return $this->fetch('', [
            'manager' => $manager
        ]);
    }

    /**
     * 退出登录
     * @param Request $request
     */
    public function logout_action(Request $request)
    {
        if ($request->isAjax()) {

            ManagerHelper::logout();

            $this->success('退出成功');
        }
    }

    /**
     * 系统信息
     * @return mixed
     */
    public function system_action()
    {
        $system = [
            '系统类型' => PHP_OS,
            '运行方式' => php_sapi_name(),
            '运行版本' => PHP_VERSION,
            '上传限制' => get_cfg_var("upload_max_filesize"),
            '执行时间' => get_cfg_var("max_execution_time") . '秒',
            '最大内存' => get_cfg_var("memory_limit"),
        ];

        return $this->fetch('system', [
            'system' => $system
        ]);
    }
}