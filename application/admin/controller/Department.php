<?php

namespace app\admin\controller;

use think\Request;

class Department extends \app\common\controller\Admin
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['Permission'];

    /**
     * 首页
     * @param Request $request
     */
    public function index_action(Request $request)
    {

        return $this->fetch();
    }
}