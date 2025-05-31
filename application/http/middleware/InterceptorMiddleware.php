<?php


namespace app\http\middleware;


use Closure;

use think\Request;

use app\common\interceptor\Interceptor;

class InterceptorMiddleware
{
    /**
     * 句柄
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $interceptors = Interceptor::getInterceptors();

        foreach ($interceptors as $interceptor) {
            (new $interceptor)->handle($request);
        }

        return $next($request);
    }
}