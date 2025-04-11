<?php


namespace app\common\helper;


use app\admin\enum\UploadEnum;
use app\common\exception\ServiceException;
use app\common\util\FileUtil;
use think\facade\Env;

class FileHelper
{
    /**
     * 获取文件完整路径
     * @param string $viewPath
     * @return string
     */
    public static function getFilePath($viewPath = '')
    {
        return Env::get('root_path') . 'public' . $viewPath;
    }

    /**
     * 获取上传目录
     * @param $fileType
     * @return string
     */
    public static function getSaveDir($fileType)
    {
        return Env::get('root_path') . 'public/' . UploadEnum::UPLOAD_DIR . '/' . $fileType;
    }

    /**
     * 获取查看路径
     * @param $fileType
     * @param string $format
     * @return string
     */
    public static function buildViewPath($fileType, $format = '')
    {
        $appendDir = '';

        if ($format == 'date') {
            $appendDir = date('Ymd') . '/';
        }

        return '/' . UploadEnum::UPLOAD_DIR . '/' . $fileType . '/' . $appendDir;
    }

    /**
     * 格式化路径
     * @param $path
     * @return string
     */
    public static function formatPath($path)
    {
        return str_replace('\\', '/', $path);
    }

    /**
     * 创建文件名
     * @param $name
     * @param $ext
     * @return string
     */
    public static function makeName($name, $ext)
    {
        return $name . '.' . $ext;
    }

    /**
     * 创建路径
     * @param $path
     * @return bool
     * @throws ServiceException
     */
    public static function makePath($path)
    {
        $path = FileUtil::getDir($path);

        if (is_dir($path)) {
            return true;
        }

        if (mkdir($path, 0777, true)) {
            return true;
        }

        throw new ServiceException('目录创建失败');
    }

    /**
     * 移动文件
     * @param $sourcePath
     * @param $targetPath
     * @return bool
     * @throws ServiceException
     */
    public static function moveFile($sourcePath, $targetPath)
    {
        if (rename($sourcePath, $targetPath)) {
            return true;
        }

        throw new ServiceException('文件移动失败');
    }
}