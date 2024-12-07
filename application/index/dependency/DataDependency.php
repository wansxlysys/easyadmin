<?php


namespace app\index\dependency;


use app\common\dependency\Dependency;
use app\index\service\DataService;

class DataDependency
{
    /**
     * 获取服务类
     * @return DataService
     */
    public static function getService()
    {
        return Dependency::get(DataService::class);
    }
}