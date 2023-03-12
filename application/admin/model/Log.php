<?php


namespace app\admin\model;


use think\Db;
use app\common\exception\RepositoryException;

class Log extends \app\common\model\Log
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