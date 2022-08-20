<?php


namespace app\common\repository;


class Role extends \app\common\repository\Repository
{
    /**
     * 初始化
     */
    public function initialize()
    {
        $this->Model = new \app\common\model\Role();
    }
}