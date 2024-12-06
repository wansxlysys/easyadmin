<?php


namespace app\index\factory;


use app\common\factory\Factory;
use app\index\service\DataService;

class DataFactory
{
    /**
     * 获取服务类
     * @return DataService
     */
    public static function getService()
    {
        return Factory::get(DataService::class);
    }
}