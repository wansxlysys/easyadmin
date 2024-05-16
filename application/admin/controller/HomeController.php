<?php


namespace app\admin\controller;


use think\Request;

use app\common\controller\AdminController;

class HomeController extends AdminController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['System'];

    /**
     * 控制台
     * @param Request $request
     * @return mixed
     */
    public function console_action(Request $request)
    {
        return $this->fetch();
    }

    /**
     * ui组件
     * @param Request $request
     * @return mixed
     */
    public function components_action(Request $request)
    {
        return $this->fetch();
    }
}