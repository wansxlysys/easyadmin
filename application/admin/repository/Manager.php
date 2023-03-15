<?php


namespace app\admin\repository;


use think\Db;
use app\common\exception\RepositoryException;

class Manager extends \app\common\repository\Manager
{
    /**
     * 通过账号查询
     * @param $account
     * @return mixed
     */
    public function getByAccount($account)
    {
        try {

            return Db::name(static::getName())->where('account', $account)->find();

        } catch (\Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }
}