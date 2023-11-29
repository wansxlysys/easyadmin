<?php


namespace app\admin\controller;


use think\facade\Config;
use editor\ueditor\Ueditor;
use app\common\controller\AdminController;

class EditorController extends AdminController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['System'];

    /**
     * 百度富文本编辑器
     * @return false|string
     */
    public function ueditor_action()
    {
        return (new Ueditor(Config::pull('ueditor')))->dispatch();
    }
}