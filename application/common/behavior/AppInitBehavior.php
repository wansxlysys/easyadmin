<?php


namespace app\common\behavior;


use think\Db;

use app\common\helper\DebugHelper;
use app\common\helper\MonologHelper;

class AppInitBehavior
{
    /**
     * 初始化钩子
     * @return void
     */
    public function run()
    {
        /**
         * 记录启动时间
         */
        DebugHelper::start();

        /**
         * 监听SQL执行
         */
        Db::listen(function ($sql, $time) {
            MonologHelper::debug('sql execute', ['sql' => $sql, 'time' => $time]);
        });
    }
}