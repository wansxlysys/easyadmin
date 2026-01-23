<?php


use app\Queue\command\QueueRetry;
use app\Admin\command\UploadClean;

use app\Common\command\database\Backup;
use app\Common\command\generator\Generator;

return [
    'database:backup' => Backup::class,
    'generator:code'  => Generator::class,
    'queue:retry'     => QueueRetry::class,
    'upload:clean'    => UploadClean::class,
];
