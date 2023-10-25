<?php


namespace app\common\util;


class FileUtil
{
    /**
     * 单位换算
     * @param $size
     * @return string
     */
    public static function formatBytes($size)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $size >= 1024 && $i < count($units); $i++) {
            $size /= 1024;
        }

        return round($size, 2) . $units[$i];
    }
}