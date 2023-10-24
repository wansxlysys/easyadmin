<?php


namespace app\admin\controller;


use think\Request;

class HomeController extends \app\common\controller\AdminController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['Permission'];

    /**
     * 控制台
     * @param Request $request
     * @return mixed
     */
    public function console_action(Request $request)
    {
        return $this->fetch();
    }
}