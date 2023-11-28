<?php


namespace app\admin\controller;


use think\facade\Config;
use editor\ueditor\Ueditor;

class EditorController extends \app\common\controller\AdminController
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