<?php


use think\facade\Env;

use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Processor\PsrLogMessageProcessor;

return [
    'default' => [
        'handlers'   => [
            [
                'class'       => RotatingFileHandler::class,
                'constructor' => [
                    Env::get('runtime_path') . 'log/default.log', Logger::DEBUG,
                ],
                'formatter'   => [
                    'class'       => LineFormatter::class,
                    'constructor' => [null, 'Y-m-d H:i:s', true],
                ],
            ]
        ],
        'processors' => [
            [
                'class' => PsrLogMessageProcessor::class,
            ],
            [
                'class'       => UidProcessor::class,
                'constructor' => [32]
            ],
        ]
    ],
    'queue'   => [
        'handlers'   => [
            [
                'class'       => RotatingFileHandler::class,
                'constructor' => [
                    Env::get('runtime_path') . 'log/queue.log', Logger::DEBUG,
                ],
                'formatter'   => [
                    'class'       => LineFormatter::class,
                    'constructor' => [null, 'Y-m-d H:i:s', true],
                ],
            ]
        ],
        'processors' => [
            [
                'class' => PsrLogMessageProcessor::class,
            ]
        ]
    ]
];
