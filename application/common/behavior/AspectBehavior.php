<?php


namespace app\common\behavior;


use think\Request;

use app\common\helper\ImportHelper;

class AspectBehavior
{
    /**
     * 初始化钩子
     * @return void
     */
    public function run(Request $request)
    {
        ImportHelper::register('aspect.php');

        if ($request->module() != '') {
            ImportHelper::register($request->module() . DIR . 'aspect.php');
        }
    }
}