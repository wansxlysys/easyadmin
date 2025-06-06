<?php


namespace app\admin\repository;


use app\common\repository\Repository;

class SystemSettingRepository extends Repository
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'system_setting';

    /**
     * 表主键
     * @var string
     */
    protected $tableId = 'settingId';
}