<?php


use app\http\middleware\RepeatMiddleware;
use app\http\middleware\MonologMiddleware;

return [
    RepeatMiddleware::class,
    MonologMiddleware::class
];