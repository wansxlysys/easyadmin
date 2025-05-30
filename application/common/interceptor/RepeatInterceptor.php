<?php


namespace app\common\interceptor;


use think\Request;

use app\common\util\Md5Util;
use app\common\util\ArrayUtil;

use app\common\helper\RedisHelper;
use app\common\exception\RepeatException;

class RepeatInterceptor implements InterceptorHandler
{
    /**
     * 锁定值
     * @var int
     */
    private $lockValue = 1;

    /**
     * 锁定时间
     * @var int
     */
    private $lockTime = 2;

    /**
     * 重复请求
     * @throws RepeatException
     */
    public function handle(Request $request)
    {
        $paramMd5 = Md5Util::encrypt(ArrayUtil::toJson($request->param()) . $request->url());
        $isLocked = RedisHelper::set($paramMd5, $this->lockValue, 'ex', $this->lockTime, 'nx');

        if ($isLocked != 'OK') {
            throw new RepeatException('请求过于频繁，请稍后再试！');
        }
    }
}