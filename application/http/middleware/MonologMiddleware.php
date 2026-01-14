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
        $log['Host']            = $request->host();
        $log['Cookie']          = $request->cookie();
        $log['Request-URL']     = $request->url();
        $log['Request-Data']    = $request->param();
        $log['Request-Method']  = $request->method();
        $log['Content-Type']    = $request->header('Content-Type');
        $log['Content-Length']  = $request->header('Content-Length');
        $log['Connection']      = $request->header('Connection');
        $log['Accept']          = $request->header('Accept');
        $log['Accept-Encoding'] = $request->header('Accept-Encoding');
        $log['Accept-Language'] = $request->header('Accept-Language');
        $log['Referer']         = $request->header('Referer');
        $log['User-Agent']      = $request->header('User-Agent');

        LogHelper::debug('Request Log', $log);

        return $next($request);
    }
}