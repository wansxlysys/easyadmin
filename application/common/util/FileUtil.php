<?php


namespace app\common\util;


class FileUtil
{
    /**
     * 获取文件目录
     * @param $path
     * @return string
     */
    public static function getDir($path)
    {
        return pathinfo($path, PATHINFO_DIRNAME);
    }

    /**
     * 获取文件名
     * @param $path
     * @return string
     */
    public static function getName($path)
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    /**
     * 获取文件后缀
     * @param $path
     * @return string
     */
    public static function getExt($path)
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }

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