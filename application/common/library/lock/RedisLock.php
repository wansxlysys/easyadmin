<?php


namespace app\common\library\lock;


use app\common\helper\RedisHelper;

class RedisLock
{
    /**
     * 锁的键
     * @var string
     */
    private $lockKey;

    /**
     * 超时时间
     * @var int
     */
    private $timeoutMs;

    /**
     * 初始化
     * @param $lockKey
     * @param $timeoutMs
     */
    public function __construct($lockKey, $timeoutMs = 5000)
    {
        $this->lockKey   = $lockKey;
        $this->timeoutMs = $timeoutMs;
    }

    /**
     * 尝试获取锁
     * @return bool 是否成功获取锁
     */
    public function acquire()
    {
        return RedisHelper::set($this->lockKey, 1, 'PX', $this->timeoutMs, 'NX') == 'OK';
    }

    /**
     * 释放锁
     * @return bool 是否成功释放锁
     */
    public function release()
    {
        return RedisHelper::del($this->lockKey) == 1;
    }

    /**
     * 带超时的锁获取（轮询方式）
     *
     * @param int $waitTimeoutMs 等待时间
     * @return bool 是否成功获取锁
     */
    public function acquireWithWait($waitTimeoutMs = 3000, $retryDelayMs = 100)
    {
        while ($waitTimeoutMs > 0) {
            $waitTimeoutMs -= $retryDelayMs;
            if ($this->acquire()) {
                return true;
            }
            usleep($retryDelayMs * 1000);
        }
        return false;
    }
}