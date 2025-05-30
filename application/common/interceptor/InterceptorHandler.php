<?php


namespace app\common\interceptor;


use think\Request;

interface InterceptorHandler
{
    public function handle(Request $request);
}