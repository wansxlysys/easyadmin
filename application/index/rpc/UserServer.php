<?php


namespace app\index\rpc;


class UserServer
{
    /**
     * 通过用户ID查询
     * @param $userId
     * @return mixed
     */
    public function getUserById($userId)
    {
        return [
            'userId' => $userId
        ];
    }
}