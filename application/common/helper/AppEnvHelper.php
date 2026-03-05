<?php


namespace app\common\helper;


use think\facade\Env;

class AppEnvHelper
{
    /**
     * 获取当前环境
     * @return string
     */
    public static function getEnv()
    {
        return Env::get('APP_ENV');
    }

    /**
     * 是否是测试环境
     * @return bool
     */
    public static function isTest()
    {
        return static::getEnv() === 'test';
    }

    /**
     * 是否是生产环境
     * @return bool
     */
    public static function isProd()
    {
        return static::getEnv() === 'prod';
    }

    /**
     * 是否是本地环境
     * @return bool
     */
    public static function isLocal()
    {
        return static::getEnv() === 'local';
    }
}