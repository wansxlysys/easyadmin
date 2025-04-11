<?php


namespace app\admin\controller;


use app\admin\dependency\SystemMenuDependency;
use app\admin\helper\SystemManagerHelper;
use app\admin\service\ManagerService;
use app\admin\validate\ManagerValidate;
use app\common\controller\SystemController;
use Exception;
use think\Request;

class IndexController extends SystemController
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
    public function indexAction()
    {
        $menuTree = SystemMenuDependency::getService()->getLeftMenu();

        return $this->fetch('', [
            'menuTree' => $menuTree
        ]);
    }

    /**
     * 控制台
     * @param Request $request
     * @return mixed
     */
    public function consoleAction(Request $request)
    {
        return $this->fetch();
    }

    /**
     * ui组件
     * @param Request $request
     * @return mixed
     */
    public function componentsAction(Request $request)
    {
        return $this->fetch();
    }

    /**
     * 个人资料
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function profileAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id'       => SystemManagerHelper::getManagerId(),
                'avatar'   => $request->post('avatar'),
                'realName' => $request->post('realName'),
                'password' => $request->post('password'),
            ];

            $this->ManagerValidate->scene('Profile')->verify($params);
            $this->ManagerService->updateManager($params);

            $this->success('修改成功');
        }

        $manager = SystemManagerHelper::getManager();

        return $this->fetch('', [
            'manager' => $manager
        ]);
    }

    /**
     * 退出登录
     * @param Request $request
     */
    public function logoutAction(Request $request)
    {
        if ($request->isAjax()) {

            SystemManagerHelper::logout();

            $this->success('退出成功');
        }
    }

    /**
     * 系统信息
     * @return mixed
     */
    public function systemAction()
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