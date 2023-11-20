<?php


namespace app\admin\controller;


use think\Request;
use app\admin\service\SystemLoginLogService;

class SystemLoginLogController extends \app\common\controller\AdminController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['System'];

    /**
     * 服务类
     * @var SystemLoginLogService
     */
    protected $SystemLoginLogService;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemLoginLogService = new SystemLoginLogService();
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

            $this->success('获取成功', '', $this->SystemLoginLogService->listLog($params));
        }

        return $this->fetch();
    }

    /**
     * 详情
     * @param Request $request
     * @return mixed
     */
    public function detail_action(Request $request)
    {
        $log = $this->SystemLoginLogService->detailLog($request->get('id'));

        return $this->fetch('', [
            'log' => $log
        ]);
    }

    /**
     * 清空
     * @param Request $request
     */
    public function clear_action(Request $request)
    {
        if ($request->isAjax()) {

            if ($this->SystemLoginLogService->clearLog()) {
                $this->success('清空成功');
            }

            $this->error('清空失败');
        }
    }
}