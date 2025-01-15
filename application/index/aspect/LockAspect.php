<?php


namespace app\index\aspect;


use app\common\helper\RedisHelper;

use app\common\exception\LockedException;

class LockAspect
{
    /**
     * 锁定时长/秒
     * @var int
     */
    public static $ttl = 2;

    /**
     * 前置通知
     * @param $methodName
     * @param $arguments
     * @return void
     * @throws LockedException
     */
    public function before($methodName, $arguments)
    {
        $lock = RedisHelper::set($methodName, true, 'ex', static::$ttl, 'nx');

        if (!$lock) {
            throw new LockedException('请求过于频繁，请稍后再试！');
        }
    }
}