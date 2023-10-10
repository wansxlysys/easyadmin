<?php


namespace app\admin\controller;


use think\Request;
use app\admin\service\MenuService;
use app\common\helper\ManagerHelper;
use app\admin\service\ManagerService;
use app\admin\validate\ManagerValidate;
use Symfony\Component\Filesystem\Filesystem;

class IndexController extends \app\common\controller\AdminController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['Permission'];

    /**
     * 服务类
     * @var MenuService
     */
    protected $MenuService;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->MenuService = new MenuService();
    }

    /**
     * 首页
     * @return mixed
     */
    public function index_action()
    {
        $menu    = $this->MenuService->getLeftMenu();
        $manager = ManagerHelper::getManager();

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
                'avatar'   => $request->post('avatar'),
                'real_name' => $request->post('real_name'),
                'password' => $request->post('password'),
            ];

            $params['id'] = ManagerHelper::getManagerId();

            $ManagerValidate = new ManagerValidate();

            if (!$ManagerValidate->scene('Profile')->check($params)) {
                $this->error($ManagerValidate->getError());
            }

            $ManagerService = new ManagerService();

            if (!$ManagerService->updateManager($params)) {
                $this->error('修改失败');
            }

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

    /**
     * 清除缓存
     * @param Request $request
     */
    public function clear_cache_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'cache' => $request->post('cache')
            ];

            $Filesystem = new Filesystem();

            foreach ($params['cache'] as $key => $dir) {
                $Filesystem->remove(env('runtime_path') . $dir);
            }

            $this->success("清除成功");
        }
    }
}