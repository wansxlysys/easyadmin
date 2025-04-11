<?php


namespace app\queue\repository;


use app\common\repository\Repository;

class QueueFailedRepository extends Repository
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'QueueFailed';
}