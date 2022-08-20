<?php


namespace app\admin\controller;

use think\Request;

class Index extends \app\common\controller\Admin
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['Permission'];

    /**
     * 菜单服务类
     * @var \app\admin\service\Menu
     */
    protected $MenuService;

    /**
     * 管理员服务类
     * @var \app\admin\helper\Manager
     */
    protected $ManagerHelper;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->MenuService   = new \app\admin\service\Menu();
        $this->ManagerHelper = new \app\admin\helper\Manager();
    }

    /**
     * 首页
     * @return mixed
     */
    public function index_action()
    {
        $menu    = $this->MenuService->getLeftMenu();
        $manager = $this->ManagerHelper->getManager();

        return $this->fetch('', [
            'menu'    => $menu,
            'manager' => $manager
        ]);
    }

    /**
     * 修改个人资料
     * @param Request $request
     * @return mixed
     */
    public function profile_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id'       => $this->ManagerHelper->getManagerId(),
                'avatar'   => $request->post('avatar'),
                'nickname' => $request->post('nickname'),
                'password' => $request->post('password'),
            ];

            $ManagerValidate = new \app\admin\validate\Manager();

            if (!$ManagerValidate->scene('profile')->check($params)) {
                $this->error($ManagerValidate->getError());
            }

            $ManagerService = new \app\admin\service\Manager();

            if (!$ManagerService->updateByParamsId($params)) {
                $this->error('修改失败');
            }

            $this->success('修改成功');
        }

        $manager = $this->ManagerHelper->getManager();

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

            $this->ManagerHelper->logout();

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

    /**
     * 清除缓存
     * @param Request $request
     */
    public function clear_cache_action(Request $request)
    {
        if ($request->isAjax()) {
            $params = [
                'cache' => $request->post('cache', ['log', 'cache', 'temp'])
            ];

            $Filesystem = new \Symfony\Component\Filesystem\Filesystem();

            foreach ($params['cache'] as $key => $vo) {
                $Filesystem->remove(env('runtime_path') . $vo);
            }

            $this->success("清除成功");
        }
    }
}