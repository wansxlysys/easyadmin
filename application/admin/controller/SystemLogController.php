<?php


namespace app\admin\controller;


use Exception;

use think\Request;

use app\admin\service\SystemLogService;
use app\admin\dependency\SystemLogDependency;

use app\common\controller\SystemController;

class SystemLogController extends SystemController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['System'];

    /**
     * 服务类
     * @var SystemLogService
     */
    protected $SystemLogService;

    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemLogService = SystemLogDependency::getService();
    }

    /**
     * 首页
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function indexAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'menu'    => $request->get('menu'),
                'page'    => $request->get('page'),
                'limit'   => $request->get('limit'),
                'status'  => $request->get('status'),
                'account' => $request->get('account')
            ];

            $this->success('获取成功', '', $this->SystemLogService->listLog($params));
        }

        return $this->fetch();
    }

    /**
     * 详情
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function detailAction(Request $request)
    {
        $log = $this->SystemLogService->detailLog($request->get('id'));

        return $this->fetch('', [
            'log' => $log
        ]);
    }

    /**
     * 清空
     * @param Request $request
     * @throws Exception
     */
    public function clearAction(Request $request)
    {
        if ($request->isAjax()) {

            $this->SystemLogService->clearLog();

            $this->success('清空成功');
        }
    }
}