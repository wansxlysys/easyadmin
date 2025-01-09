<?php


namespace app\index\dependency;


use app\common\dependency\Dependency;
use app\index\service\UserService;

class UserDependency
{
    /**
     * 获取服务类
     * @return UserService
     */
    public static function getService()
    {
        return Dependency::getProxy(UserService::class);
    }
}