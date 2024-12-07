<?php


namespace app\common\dependency;


use app\common\service\SystemUploadService;
use app\common\validate\SystemUploadValidate;
use app\common\repository\SystemUploadRepository;

class SystemUploadDependency
{
    /**
     * 获取存储类
     * @return SystemUploadRepository
     */
    public static function getRepository()
    {
        return Dependency::get(SystemUploadRepository::class);
    }

    /**
     * 获取服务类
     * @return SystemUploadService
     */
    public static function getService()
    {
        return Dependency::get(SystemUploadService::class);
    }

    /**
     * 获取验证器
     * @return SystemUploadValidate
     */
    public static function getValidate()
    {
        return Dependency::get(SystemUploadValidate::class);
    }
}