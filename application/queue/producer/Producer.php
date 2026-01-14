<?php


namespace app\queue\producer;


use think\Queue;

use app\common\util\StringUtil;

abstract class Producer
{
    /**
     * 投递队列
     * @param $consumer
     * @param $method
     * @param $params
     * @param $queue
     * @return void
     */
    public static function push($consumer, $method, $params, $queue = null)
    {
        Queue::push($consumer . '@fire', static::buildData($method, $params), $queue);
    }

    /**
     * 投递队列
     * @param $consumer
     * @param $method
     * @param $params
     * @param $delay
     * @param null $queue
     * @return void
     */
    public static function delay($consumer, $method, $params, $delay, $queue = null)
    {
        Queue::later($delay, $consumer . '@fire', static::buildData($method, $params), $queue);
    }

    /**
     * 构建数据
     * @param $method
     * @param $params
     * @return array
     */
    private static function buildData($method, $params)
    {
        return ['method' => $method, 'uniqid' => StringUtil::unique(), 'params' => $params];
    }
}