<?php


use app\Common\middleware\MonologMiddleware;
use app\Common\middleware\RepeatMiddleware;

return [
    MonologMiddleware::class,
    RepeatMiddleware::class
];