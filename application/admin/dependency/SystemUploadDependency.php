<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemUploadService;
use app\admin\validate\SystemUploadValidate;

class SystemUploadDependency extends \app\common\dependency\SystemUploadDependency
{
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