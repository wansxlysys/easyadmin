<?php


namespace app\admin\model;


use think\Db;
use app\common\exception\RepositoryException;

class Manager extends \app\common\model\Manager
{
    /**
     * 通过用户名查询
     * @param $account
     * @return mixed
     */
    public function getByUserName($account)
    {
        try {

            return Db::name(static::getName())->where('username', $account)->find();

        } catch (\Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }
}