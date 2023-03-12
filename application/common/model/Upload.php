<?php


namespace app\common\model;


use think\Db;
use app\common\exception\RepositoryException;

class Upload extends \app\common\model\Model
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'Upload';

    /**
     * 通过MD5查询
     * @param $md5
     * @return mixed
     */
    public function getByMd5($md5)
    {
        try {

            return Db::name(static::getName())->where('md5', $md5)->find();

        } catch (\Throwable $throwable) {
            throw new RepositoryException($throwable->getMessage());
        }
    }
}