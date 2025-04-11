<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemUploadService;
use app\admin\validate\SystemUploadValidate;
use app\admin\repository\SystemUploadRepository;

class SystemUploadDependency
{
    /**
     * 获取存储类
     * @return SystemUploadRepository
     */
    public static function getRepository()
    {
        return Dependency::getProxy(SystemUploadRepository::class);
    }

    /**
     * 获取服务类
     * @return SystemUploadService
     */
    public static function getService()
    {
        return Dependency::getProxy(SystemUploadService::class);
    }

    /**
     * 获取验证器
     * @return SystemUploadValidate
     */
    public static function getValidate()
    {
        return Dependency::getProxy(SystemUploadValidate::class);
    }
}