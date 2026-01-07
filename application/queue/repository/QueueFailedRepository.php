<?php


namespace app\queue\repository;


use app\common\repository\Repository;

class QueueFailedRepository extends Repository
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'queue_failed';

    /**
     * 表主键
     * @var string
     */
    protected $tableId = 'queueId';
}