<?php


namespace app\common\behavior;


use think\Db;

use app\common\helper\MonologHelper;

class AppInitBehavior
{
    /**
     * 初始化钩子
     * @return void
     */
    public function run()
    {
        Db::listen(function ($sql, $time) {
            MonologHelper::debug('sql execute', ['sql' => $sql, 'time' => $time]);
        });
    }
}