<?php


namespace app\admin\controller;


use think\Request;

class SystemLoginLog extends \app\common\controller\Admin
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['Permission'];

    /**
     * 日志服务类
     * @var \app\admin\service\SystemLoginLog
     */
    protected $SystemLoginLogService;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemLoginLogService = new \app\admin\service\SystemLoginLog();
    }

    /**
     * 首页
     * @param Request $request
     * @return mixed
     */
    public function index_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'menu'    => $request->get('menu'),
                'page'    => $request->get('page'),
                'limit'   => $request->get('limit'),
                'status'  => $request->get('status'),
                'account' => $request->get('account')
            ];

            $this->success('获取成功', '', $this->SystemLoginLogService->getListWithTotal($params));
        }

        return $this->fetch();
    }

    /**
     * 日志详情
     * @param Request $request
     * @return mixed
     */
    public function detail_action(Request $request)
    {
        $ManagerService = new \app\admin\service\Manager();

        $log     = $this->SystemLoginLogService->getById($request->get('id'));
        $manager = $ManagerService->getById($log['manager_id']);

        return $this->fetch('', [
            'log'     => $log,
            'manager' => $manager
        ]);
    }

    /**
     * 清空日志
     * @param Request $request
     */
    public function clear_action(Request $request)
    {
        if ($request->isAjax()) {

            $result = $this->SystemLoginLogService->clearSystemLoginLog();

            if ($result === true) {
                $this->success('清空成功');
            }

            $this->error('清空失败');
        }
    }
}