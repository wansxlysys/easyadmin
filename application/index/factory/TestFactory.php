<?php


namespace app\index\factory;


use app\common\factory\Factory;
use app\index\service\TestService;

class TestFactory
{
    /**
     * 获取服务类
     * @return TestService
     */
    public static function getService()
    {
        return Factory::get(TestService::class);
    }
}