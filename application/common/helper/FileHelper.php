<?php


namespace app\common\helper;


use think\facade\Env;

use app\admin\enum\SystemUploadEnum;
use app\common\exception\ServiceException;

class FileHelper
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
     * @param $fileName
     * @return string
     */
    public static function getSavePath($fileName)
    {
        return SystemUploadEnum::UPLOAD_DIR . '/' . date('Ymd') . '/' . static::makeFileName($fileName);
    }

    /**
     * 创建文件名
     * @param $fileName
     * @return string
     */
    public static function makeFileName($fileName)
    {
        return md5(uniqid($fileName, true)) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
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
     * 获取文件类型
     * @param $fileType
     * @return string
     */
    public static function getFileType($fileType)
    {
        if (isset(SystemUploadEnum::FILE_TYPE[$fileType])) {
            return SystemUploadEnum::FILE_TYPE[$fileType];
        }

        throw new ServiceException('文件类型禁止上传');
    }
}