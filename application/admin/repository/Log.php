<?php


namespace app\admin\repository;


class Log extends \app\common\repository\Log
{
    /**
     * 清空全部
     * @return mixed
     */
    public function clear()
    {
        return $this->Model->destroy(function ($query) {
            $query->where('id', '>', 0);
        });
    }
}