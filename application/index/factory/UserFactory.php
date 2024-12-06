<?php


namespace app\index\factory;


use app\common\factory\Factory;
use app\index\service\UserService;

class UserFactory
{
    /**
     * 获取服务类
     * @return UserService
     */
    public static function getService()
    {
        return Factory::get(UserService::class);
    }
}