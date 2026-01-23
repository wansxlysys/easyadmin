<?php


namespace app\admin\repository;


use app\common\repository\Repository;

class SystemUploadRepository extends Repository
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'system_upload';

    /**
     * 表主键
     * @var string
     */
    protected $tableId = 'fileId';
}