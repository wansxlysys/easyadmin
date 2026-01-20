<?php


use app\common\middleware\MonologMiddleware;
use app\common\middleware\RepeatMiddleware;

return [
    MonologMiddleware::class,
    RepeatMiddleware::class
];