<?php


namespace app\common\repository;


use think\Db;
use think\Exception;

class SystemUploadRepository extends Repository
{
    /**
     * 数据表名
     * @var string
     */
    protected $name = 'SystemUpload';

    /**
     * 通过MD5查询
     * @param $md5
     * @return mixed
     * @throws Exception
     */
    public function getByMd5($md5)
    {
        return Db::name($this->getName())->where('md5', $md5)->find();
    }
}