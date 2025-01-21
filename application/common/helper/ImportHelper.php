<?php


namespace app\common\helper;


use think\facade\Env;

class ImportHelper
{
    /**
     * 加载文件
     * @param $fileName
     * @param $basePath
     * @return void
     */
    public static function register($fileName, $basePath = '')
    {
        if (empty($basePath)) {
            $basePath = Env::get('app_path');
        }

        $commonPath = $basePath . $fileName;

        if (file_exists($commonPath)) {
            include $commonPath;
        }
    }
}