<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemDictDataService;
use app\admin\validate\SystemDictDataValidate;
use app\admin\repository\SystemDictDataRepository;

class SystemDictDataDependency
{
    /**
     * 获取存储类
     * @return SystemDictDataRepository
     */
    public static function getRepository()
    {
        return Dependency::getProxy(SystemDictDataRepository::class);
    }

    /**
     * 获取服务类
     * @return SystemDictDataService
     */
    public static function getService()
    {
        return Dependency::getProxy(SystemDictDataService::class);
    }

    /**
     * 获取验证器
     * @return SystemDictDataValidate
     */
    public static function getValidate()
    {
        return Dependency::getProxy(SystemDictDataValidate::class);
    }
}