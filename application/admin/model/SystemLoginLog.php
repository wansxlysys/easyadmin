<?php


namespace app\admin\model;


use think\Db;
use app\common\exception\RepositoryException;

class SystemLoginLog extends \app\common\model\SystemLoginLog
{
    /**
     * 清空系统登录日志
     */
    public function clearSystemLoginLog()
    {
        try {

            return false !== Db::name(static::getName())->where('id', '>', 0)->delete();

        } catch (\Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }
}