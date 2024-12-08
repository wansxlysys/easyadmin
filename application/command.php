<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

use app\common\command\backup\Backup;
use app\common\command\generator\Generator;

use app\queue\command\QueueRetry;

return [
    'system:backup'    => Backup::class,
    'system:generator' => Generator::class,
    'queue:retry'      => QueueRetry::class,
];
