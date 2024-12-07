<?php


namespace app\common\service;


use Exception;

use think\File;

use app\common\helper\FileHelper;
use app\common\exception\ServiceException;
use app\common\repository\SystemUploadRepository;

class SystemUploadService extends Service
{
    /**
     * 存储类
     * @var SystemUploadRepository
     */
    protected $SystemUploadRepository;

    /**
     * 初始化
     */
    public function injectDependency(SystemUploadRepository $SystemUploadRepository)
    {
        $this->SystemUploadRepository = $SystemUploadRepository;
    }

    /**
     * 保存文件
     * @param File $file
     * @param $fileType
     * @return array
     * @throws Exception
     */
    public function saveFile(File $file, $fileType)
    {
        /**
         * 通过md5检测文件是否已经存在
         */
        $exists = $this->getFileByMd5($file->hash('md5'));

        if ($exists) {
            return [
                'fileName' => $exists['name'],
                'viewPath' => $exists['path'],
                'savePath' => FileHelper::getFilePath($exists['path'])
            ];
        }

        /**
         * 保存文件
         */
        $viewPath = FileHelper::buildViewPath($fileType);
        $fileInfo = $file->move(FileHelper::getSaveDir($fileType));

        if (!$fileInfo) {
            throw new ServiceException('文件上传失败');
        }

        /**
         * 创建文件数据
         */
        $savePath = FileHelper::formatPath($fileInfo->getPathname());
        $viewPath = FileHelper::formatPath($viewPath . $fileInfo->getSaveName());

        $fileData['path'] = $viewPath;
        $fileData['md5']  = $fileInfo->hash('md5');
        $fileData['name'] = $fileInfo->getInfo('name');
        $fileData['size'] = $fileInfo->getInfo('size');
        $fileData['ext']  = $fileInfo->getExtension();

        if (!$this->SystemUploadRepository->createRecord($fileData)) {
            throw new ServiceException('文件上传失败');
        }

        return ['viewPath' => $viewPath, 'savePath' => $savePath, 'fileName' => $fileData['name']];
    }

    /**
     * 保存切片
     * @param $fileInfo
     * @param $fileType
     * @return array|bool[]
     * @throws Exception
     */
    public function saveSlice($fileInfo, $fileType = 'slice')
    {
        $tempName = FileHelper::makeName($fileInfo['md5'], 'temp');
        $tempPath = FileHelper::getFilePath(FileHelper::buildViewPath('temp') . $tempName);

        /**
         * 创建文件夹
         */
        FileHelper::makePath($tempPath);

        $realPath = $fileInfo['file']->getRealPath();

        if (!file_put_contents($tempPath, file_get_contents($realPath), FILE_APPEND)) {
            throw new ServiceException('文件写入失败');
        }

        /**
         * 检测是否上传完成
         */
        if ($fileInfo['index'] >= $fileInfo['total']) {

            $saveName = FileHelper::makeName($fileInfo['md5'], $fileInfo['suffix']);
            $viewPath = FileHelper::buildViewPath($fileType, 'date') . $saveName;
            $savePath = FileHelper::getFilePath($viewPath);

            /**
             * 创建文件夹
             */
            FileHelper::makePath($savePath);

            /**
             * 移动到上传目录
             */
            FileHelper::moveFile($tempPath, $savePath);

            $fileData['path'] = $viewPath;
            $fileData['md5']  = $fileInfo['md5'];
            $fileData['name'] = $fileInfo['name'];
            $fileData['size'] = $fileInfo['size'];
            $fileData['ext']  = $fileInfo['suffix'];

            if (!$this->SystemUploadRepository->createRecord($fileData)) {
                throw new ServiceException('文件保存失败');
            }

            return ['isFinish' => true, 'viewPath' => $viewPath, 'savePath' => $savePath, 'fileName' => $fileData['name']];
        }

        return ['isFinish' => false];
    }

    /**
     * 通过Md5获取文件
     * @param $md5
     * @return mixed
     * @throws Exception
     */
    public function getFileByMd5($md5)
    {
        $file = $this->SystemUploadRepository->getByMd5($md5);

        if (!$file) {
            return false;
        }

        /**
         * 检测文件在本地是否真实存在
         */
        $savePath = FileHelper::getFilePath($file['path']);

        if (file_exists($savePath)) {
            return $file;
        }

        /**
         * 文件不存在则删除文件信息
         */
        $this->SystemUploadRepository->deleteById($file['id']);

        return false;
    }
}