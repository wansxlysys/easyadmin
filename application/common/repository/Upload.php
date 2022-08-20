<?php


namespace app\common\repository;


class Upload extends \app\common\repository\Repository
{
    /**
     * 初始化
     */
    public function initialize()
    {
        $this->Model = new \app\common\model\Upload();
    }

    /**
     * 通过MD5查询
     * @param $md5
     * @return mixed
     */
    public function getByMd5($md5)
    {
        return $this->Model->where('md5', $md5)->find();
    }
}