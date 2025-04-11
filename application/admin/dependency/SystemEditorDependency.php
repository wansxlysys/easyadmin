<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\SystemEditorService;

class SystemEditorDependency
{
    /**
     * 获取服务类
     * @return SystemEditorService
     */
    public static function getService()
    {
        return Dependency::getProxy(SystemEditorService::class);
    }
}