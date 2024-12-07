<?php


namespace app\common\dependency;


use app\common\service\EditorService;

class EditorDependency
{
    /**
     * 获取服务类
     * @return EditorService
     */
    public static function getService()
    {
        return Dependency::get(EditorService::class);
    }
}