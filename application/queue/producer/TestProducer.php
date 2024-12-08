<?php


namespace app\queue\producer;


use app\queue\consumer\TesConsumer;

class TestProducer extends Producer
{
    /**
     * 测试方法
     * @param array $data
     * @return void
     */
    public static function test(array $data)
    {
        static::push(TesConsumer::class, 'test', $data);
    }
}