<?php


namespace app\common\repository;


class Log extends \app\common\repository\Repository
{
    /**
     * 初始化
     */
    public function initialize()
    {
        $this->Model = new \app\common\model\Log();
    }
}