<?php


namespace app\index\rpc;


use Throwable;
use app\common\rpc\JsonRpc;

class UserRpc extends JsonRpc
{
    /**
     * 命名空间
     * @var string
     */
    protected $target = 'test';

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

    /**
     * 通过用户ID查询
     * @return mixed
     * @throws Throwable
     */
    public function getUserInfo()
    {
        return $this->sendRequest('getUserInfo');
    }
}