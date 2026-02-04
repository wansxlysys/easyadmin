<?php


namespace app\admin\helper;


use think\facade\Env;

use app\admin\constant\SystemUploadConstant;

use app\common\exception\ServiceException;

class SystemUploadHelper
{
    /**
     * 获取文件完整路径
     * @param string $savePath
     * @return string
     */
    public static function getRootPath($savePath = '')
    {
        return Env::get('root_path') . 'public' . $savePath;
    }

    /**
     * 构建路径
     * @param $fileType
     * @param $fileName
     * @return string
     */
    public static function getSavePath($fileType, $fileName)
    {
        return SystemUploadConstant::UPLOAD_DIR . '/' . $fileType . '/' . date('Ymd') . '/' . static::makeFileName($fileName);
    }

    /**
     * 获取文件后缀
     * @param $fileName
     * @return string
     */
    public static function getExtension($fileName)
    {
        return pathinfo($fileName, PATHINFO_EXTENSION);
    }

    /**
     * 创建文件名
     * @param $fileName
     * @return string
     */
    public static function makeFileName($fileName)
    {
        return md5(uniqid($fileName, true)) . '.' . static::getExtension($fileName);
    }

    /**
     * 获取文件hash
     * @param $savePath
     * @return string
     */
    public static function getFileHash($savePath)
    {
        /**
         * 设置脚本超时
         */
        set_time_limit(0);

        /**
         * 获取文件hash
         */
        return md5_file(static::getRootPath($savePath));
    }

    /**
     * 创建文件名
     * @param $savePath
     * @param $content
     */
    public static function putContent($savePath, $content)
    {
        $rootPath = static::getRootPath($savePath);

        /**
         * 创建文件夹
         */
        static::makeDir($rootPath);

        /**
         * 追加内容
         */
        if (!file_put_contents($rootPath, file_get_contents($content), FILE_APPEND)) {
            throw new ServiceException('文件写入失败');
        }
    }

    /**
     * 创建路径
     * @param $dirName
     * @return bool
     * @throws ServiceException
     */
    public static function makeDir($dirName)
    {
        $dirPath = pathinfo($dirName, PATHINFO_DIRNAME);

        if (is_dir($dirPath)) {
            return true;
        }

        if (mkdir($dirPath, 0777, true)) {
            return true;
        }

        throw new ServiceException('目录创建失败');
    }

    /**
     * 字节转换
     * @param $byte
     * @return float
     */
    public static function fileSizeToMb($byte)
    {
        return round($byte / 1024 / 1024, 2);
    }
}