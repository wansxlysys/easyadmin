<?php


namespace app\common\rpc;


use Throwable;

class DemoClient extends BaseClient
{
    /**
     * 请求服务
     * @var string
     */
    protected $target = 'DemoServer';

    /**
     * 查询信息
     * @param $user
     * @param array $data
     * @return mixed
     * @throws Throwable
     */
    public function getInfo($user, array $data)
    {
        $params = [
            'user' => $user,
            'data' => $data
        ];

        return $this->dispatch('getInfo', $params);
    }
}