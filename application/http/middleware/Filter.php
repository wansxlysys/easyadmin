<?php


namespace app\http\middleware;


use Closure;

use think\Request;

class Filter
{
    /**
     * 句柄
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        App::controller($request->controller());
//        var_dump(App::controller($request->controller()));
//        var_dump($request->controller());
        return $next($request);
    }
}