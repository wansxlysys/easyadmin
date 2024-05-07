<?php


namespace app\rpc\server;


class DemoServer extends BaseServer
{
    /**
     * 通过用户ID查询
     * @param $user
     * @param array $data
     * @return mixed
     */
    public function getInfo($user, array $data)
    {
        return [
            'user' => $user,
            'data' => $data
        ];
    }
}