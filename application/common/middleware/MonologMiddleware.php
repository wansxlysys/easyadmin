<?php


namespace app\common\middleware;


use Closure;

use think\Request;

use app\common\helper\DebugHelper;
use app\common\helper\MonologHelper;

class MonologMiddleware
{
    /**
     * 日志中间件
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $log['Ip']              = $request->ip();
        $log['Host']            = $request->host();
        $log['Cookie']          = $request->cookie();
        $log['Request-URL']     = $request->url();
        $log['Request-Method']  = $request->method();
        $log['Request-Param']   = $this->filterParams($request->param());
        $log['Connection']      = $request->header('Connection');
        $log['Content-Type']    = $request->header('Content-Type');
        $log['Content-Length']  = $request->header('Content-Length');
        $log['Accept']          = $request->header('Accept');
        $log['Accept-Encoding'] = $request->header('Accept-Encoding');
        $log['Accept-Language'] = $request->header('Accept-Language');
        $log['Referer']         = $request->header('Referer');
        $log['User-Agent']      = $request->header('User-Agent');
        $log['Cost-Time']       = DebugHelper::duration();

        MonologHelper::debug('request log', $log);

        return $next($request);
    }

    /**
     * 过滤参数
     * @param $params
     * @return mixed
     */
    private function filterParams($params)
    {
        if (!empty($params['password'])) {
            $params['password'] = '******';
        }

        return $params;
    }
}