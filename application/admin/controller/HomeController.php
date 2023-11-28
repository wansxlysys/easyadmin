<?php


namespace app\admin\controller;


use think\Request;

class HomeController extends \app\common\controller\AdminController
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