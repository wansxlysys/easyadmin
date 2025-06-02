<?php


namespace app\common\interceptor;


use think\Request;

use app\common\util\Md5Util;
use app\common\util\ArrayUtil;
use app\common\helper\RepeatHelper;
use app\common\helper\MatcheHelper;
use app\common\exception\RepeatException;

class RepeatInterceptor implements InterceptorHandler
{
    /**
     * 包含请求
     * @var array
     */
    private $includePatterns = [];

    /**
     * 排除请求
     * @var array
     */
    private $excludePatterns = [];

    /**
     * 重复请求
     * @throws RepeatException
     */
    public function handle(Request $request)
    {
        $url = $request->url();

        /**
         * 检查包含规则
         */
        if (!MatcheHelper::matchesAny($this->includePatterns, $url)) {
            return;
        }

        /**
         * 检查排除规则
         */
        if (MatcheHelper::matchesAny($this->excludePatterns, $url)) {
            return;
        }

        $requestId = Md5Util::encrypt(
            ArrayUtil::toJson($request->param()) . $request->url() . $request->ip() . $request->method()
        );

        if (RepeatHelper::isRepeat($requestId)) {
            throw new RepeatException('请求过于频繁，请稍后再试！');
        }
    }
}