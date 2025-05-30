<?php


namespace app\http\middleware;


use Closure;

use think\Request;

use app\common\interceptor\Interceptor;

class FilterMiddleware
{
    /**
     * 句柄
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $filters = Interceptor::getFilters();

        foreach ($filters as $filter) {
            (new $filter)->handle($request);
        }

        return $next($request);
    }
}