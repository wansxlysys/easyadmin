<?php


use app\http\middleware\RepeatMiddleware;
use app\http\middleware\MonologMiddleware;

return [
    MonologMiddleware::class,
    RepeatMiddleware::class
];