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
     * @return mixed
     */
    public function console_action()
    {
        return $this->fetch();
    }

    /**
     * 仪表板
     * @return mixed
     */
    public function dashboard_action()
    {
        return $this->fetch();
    }

    /**
     * ui组件
     * @return mixed
     */
    public function components_action()
    {
        return $this->fetch();
    }
}