<?php


namespace app\common\repository;


use think\Db;
use Throwable;
use app\common\exception\RepositoryException;

class ManagerRepository extends Model
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'Manager';

    /**
     * 通过账号查询
     * @param $account
     * @return mixed
     */
    public function getByAccount($account)
    {
        try {

            return Db::name(static::getName())->where('account', $account)->find();

        } catch (Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }
}