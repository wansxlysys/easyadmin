<?php


namespace app\index\dependency;


use app\common\dependency\Dependency;
use app\index\service\TestService;

class TestDependency
{
    /**
     * 获取服务类
     * @return TestService
     */
    public static function getService()
    {
        return Dependency::getProxy(TestService::class);
    }
}