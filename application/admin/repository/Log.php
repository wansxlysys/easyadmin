<?php


namespace app\admin\repository;


use think\Db;
use app\common\exception\RepositoryException;

class Log extends \app\common\repository\Log
{
    /**
     * 清空全部
     * @return mixed
     */
    public function clear()
    {
        try {

            return Db::name(static::getName())->where('id', '>', 0)->delete();

        } catch (\Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }
}