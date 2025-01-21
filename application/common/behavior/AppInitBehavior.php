<?php


namespace app\common\behavior;


class AppInitBehavior
{
    /**
     * 初始化钩子
     * @return void
     */
    public function run()
    {
        // 目录分割符
        define('DIR', '/');
    }
}