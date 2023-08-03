<?php


namespace app\admin\controller;


use think\Request;
use app\admin\service\LogService;

class LogController extends \app\common\controller\AdminController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['Permission'];

    /**
     * 日志服务类
     * @var LogService
     */
    protected $LogService;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->LogService = new LogService();
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

            $this->success('获取成功', '', $this->LogService->getListWithTotal($params));
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
        $log = $this->LogService->getDetail($request->get('id'));

        return $this->fetch('', [
            'log' => $log
        ]);
    }

    /**
     * 清空日志
     * @param Request $request
     */
    public function clear_action(Request $request)
    {
        if ($request->isAjax()) {

            if ($this->LogService->clear()) {
                $this->success('清空成功');
            }

            $this->error('清空失败');
        }
    }
}