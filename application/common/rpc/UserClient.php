<?php


namespace app\common\rpc;


use Throwable;

class UserClient extends Client
{
    /**
     * 请求服务
     * @var string
     */
    protected $target = 'userServer';

    /**
     * 通过用户ID查询
     * @param $userId
     * @return mixed
     * @throws Throwable
     */
    public function getUserById($userId)
    {
        $params = [
            'userId' => $userId
        ];

        return $this->sendRequest('getUserById', $params);
    }
}