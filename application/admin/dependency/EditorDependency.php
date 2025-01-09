<?php


namespace app\admin\dependency;


use app\common\dependency\Dependency;

use app\admin\service\EditorService;

class EditorDependency extends \app\common\dependency\EditorDependency
{
    /**
     * 获取服务类
     * @return EditorService
     */
    public static function getService()
    {
        return Dependency::getProxy(EditorService::class);
    }
}