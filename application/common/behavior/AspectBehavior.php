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
        /**
         * 加载全局切面配置类
         */
        ImportHelper::register('aspect.php');

        /**
         * 加载模块切面配置类
         */
        if ($request->module() != '') {
            ImportHelper::register($request->module() . DIR . 'aspect.php');
        }
    }
}