<?php


namespace app\admin\controller;


use think\facade\Config;

class Editor extends \app\common\controller\Admin
{
    /**
     * 百度富文本编辑器
     * @return false|string
     */
    public function ueditor_action()
    {
        $config  = Config::pull('ueditor');
        $Ueditor = new \editor\ueditor\Ueditor($config);

        return $Ueditor->action();
    }

}