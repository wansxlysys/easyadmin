<?php


namespace app\common\middleware;


use Closure;
use think\Request;

use app\common\util\Md5Util;
use app\common\util\ArrayUtil;
use app\common\util\MatcheUtil;
use app\common\helper\RepeatHelper;
use app\common\exception\RepeatException;

class RepeatMiddleware
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
     * 句柄
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $url = $request->url();

        /**
         * 检查包含规则
         */
        if (!MatcheUtil::matchesAny($this->includePatterns, $url)) {
            return $next($request);
        }

        /**
         * 检查排除规则
         */
        if (MatcheUtil::matchesAny($this->excludePatterns, $url)) {
            return $next($request);
        }

        $requestId = Md5Util::encrypt(
            ArrayUtil::toJson($request->param()) . $request->url() . $request->ip() . $request->method()
        );

        if (RepeatHelper::isRepeat($requestId)) {
            throw new RepeatException('请求过于频繁，请稍后再试！');
        }

        return $next($request);
    }
}