<?php


namespace app\http\middleware;


use Closure;

use think\Request;

use app\common\helper\LogHelper;

class MonologMiddleware
{
    /**
     * 句柄
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $log['host']      = $request->host();
        $log['path']      = $request->path();
        $log['method']    = $request->method();
        $log['domain']    = $request->domain();
        $log['params']    = $request->param();
        $log['cookie']    = $request->cookie();
        $log['userIp']    = $request->ip();
        $log['referer']   = $request->header('referer');
        $log['userAgent'] = $request->header('user-agent');

        LogHelper::info('请求日志', $log);

        return $next($request);
    }
}