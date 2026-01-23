<?php


use app\queue\command\QueueRetry;
use app\admin\command\UploadClean;

use app\common\command\database\Backup;
use app\common\command\generator\Generator;

return [
    'database:backup' => Backup::class,
    'generator:code'  => Generator::class,
    'queue:retry'     => QueueRetry::class,
    'upload:clean'    => UploadClean::class,
];
