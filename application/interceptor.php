<?php


use app\common\interceptor\Interceptor;
use app\common\interceptor\RepeatInterceptor;

Interceptor::addInterceptor(RepeatInterceptor::class);