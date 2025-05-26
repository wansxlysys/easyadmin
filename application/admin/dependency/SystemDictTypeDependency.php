<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemDictTypeService;
use app\admin\validate\SystemDictTypeValidate;
use app\admin\repository\SystemDictTypeRepository;

class SystemDictTypeDependency
{
    /**
     * 获取存储类
     * @return SystemDictTypeRepository
     */
    public static function getRepository()
    {
        return Dependency::getProxy(SystemDictTypeRepository::class);
    }

    /**
     * 获取服务类
     * @return SystemDictTypeService
     */
    public static function getService()
    {
        return Dependency::getProxy(SystemDictTypeService::class);
    }

    /**
     * 获取验证器
     * @return SystemDictTypeValidate
     */
    public static function getValidate()
    {
        return Dependency::getProxy(SystemDictTypeValidate::class);
    }
}