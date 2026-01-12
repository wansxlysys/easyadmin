<?php


use app\http\middleware\RepeatMiddleware;
use app\http\middleware\SystemLogMiddleware;

return [
    RepeatMiddleware::class,
    SystemLogMiddleware::class
];