<?php


namespace app\admin\controller;


use Exception;

use think\Request;

use app\admin\service\SystemLoginLogService;
use app\admin\dependency\SystemLoginLogDependency;

use app\common\controller\SystemController;

class SystemLoginLogController extends SystemController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['SystemMiddleware'];

    /**
     * 服务类
     * @var SystemLoginLogService
     */
    protected $SystemLoginLogService;

    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemLoginLogService = SystemLoginLogDependency::getService();
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

            $this->success('获取成功', '', $this->SystemLoginLogService->listLog($params));
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
        $log = $this->SystemLoginLogService->detailLog($request->get('logId'));

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

            $this->SystemLoginLogService->clearLog();

            $this->success('清空成功');
        }
    }
}