<?php


namespace app\common\behavior;


use think\Db;

use app\common\helper\LogHelper;

class AppInitBehavior
{
    /**
     * 初始化钩子
     * @return void
     */
    public function run()
    {
        Db::listen(function ($sql, $time) {
            LogHelper::debug('SQL Execute', ['sql' => $sql, 'time' => $time]);
        });
    }
}