<?php


namespace app\admin\service;


use Exception;

use think\File;
use think\Validate;

use app\common\util\FileUtil;
use app\common\helper\FileHelper;
use app\common\exception\ServiceException;
use app\common\exception\ValidateException;

use app\admin\enum\UploadEnum;
use app\admin\repository\SystemUploadRepository;

class SystemUploadService
{
    /**
     * 存储类
     * @var SystemUploadRepository
     */
    protected SystemUploadRepository $SystemUploadRepository;

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
        $this->SystemUploadRepository->deleteById($file['fileId']);

        return false;
    }

    /**
     * 图片上传
     * @param File $image
     * @param string $fileType
     * @return array
     * @throws Exception
     */
    public function uploadImage(File $image, $fileType = 'image')
    {
        $params = [
            'image' => $image
        ];

        $rule = [
            'image' => 'require|fileExt:' . UploadEnum::IMAGE_FILE_EXT . '|fileSize:' . UploadEnum::IMAGE_MAX_SIZE,
        ];

        $msg = [
            'image.require'  => '图片不能为空',
            'image.fileExt'  => '图片格式必须' . UploadEnum::IMAGE_FILE_EXT,
            'image.fileSize' => '图片不能超过' . FileUtil::formatBytes(UploadEnum::IMAGE_MAX_SIZE),
        ];

        $Validate = Validate::make($rule, $msg);

        if (!$Validate->check($params)) {
            throw new ValidateException($Validate->getError());
        }

        return $this->saveFile($image, $fileType);
    }

    /**
     * 视频上传
     * @param File $video
     * @param string $fileType
     * @return array
     * @throws Exception
     */
    public function uploadVideo(File $video, $fileType = 'video')
    {
        $params = [
            'video' => $video
        ];

        $rule = [
            'video' => 'require|fileExt:' . UploadEnum::VIDEO_FILE_EXT . '|fileSize:' . UploadEnum::VIDEO_MAX_SIZE,
        ];

        $msg = [
            'video.require'  => '视频不能为空',
            'video.fileExt'  => '视频格式必须' . UploadEnum::IMAGE_FILE_EXT,
            'video.fileSize' => '视频不能超过' . FileUtil::formatBytes(UploadEnum::VIDEO_MAX_SIZE),
        ];

        $Validate = Validate::make($rule, $msg);

        if (!$Validate->check($params)) {
            throw new ValidateException($Validate->getError());
        }

        return $this->saveFile($video, $fileType);
    }

    /**
     * 音频上传
     * @param File $audio
     * @param string $fileType
     * @return array
     * @throws Exception
     */
    public function uploadAudio(File $audio, $fileType = 'audio')
    {
        $params = [
            'audio' => $audio
        ];

        $rule = [
            'audio' => 'require|fileExt:' . UploadEnum::AUDIO_FILE_EXT . '|fileSize:' . UploadEnum::AUDIO_MAX_SIZE,
        ];

        $msg = [
            'audio.require'  => '音频不能为空',
            'audio.fileExt'  => '音频格式必须' . UploadEnum::IMAGE_FILE_EXT,
            'audio.fileSize' => '音频不能超过' . FileUtil::formatBytes(UploadEnum::AUDIO_MAX_SIZE),
        ];

        $Validate = Validate::make($rule, $msg);

        if (!$Validate->check($params)) {
            throw new ValidateException($Validate->getError());
        }

        return $this->saveFile($audio, $fileType);
    }

    /**
     * 文件上传
     * @param File $file
     * @param string $fileType
     * @return array
     * @throws Exception
     */
    public function uploadFile(File $file, $fileType = 'file')
    {
        $params = [
            'file' => $file
        ];

        $rule = [
            'file' => 'require|fileExt:' . UploadEnum::FILE_FILE_EXT . '|fileSize:' . UploadEnum::FILE_MAX_SIZE,
        ];

        $msg = [
            'file.require'  => '文件不能为空',
            'file.fileExt'  => '文件格式必须' . UploadEnum::FILE_FILE_EXT,
            'file.fileSize' => '文件不能超过' . FileUtil::formatBytes(UploadEnum::FILE_MAX_SIZE),
        ];

        $Validate = Validate::make($rule, $msg);

        if (!$Validate->check($params)) {
            throw new ValidateException($Validate->getError());
        }

        return $this->saveFile($file, $fileType);
    }

    /**
     * 文件上传
     * @param array $params
     * @param string $fileType
     * @return array
     * @throws Exception
     */
    public function uploadSlice(array $params, $fileType = 'file')
    {
        $rule = [
            'size'   => 'require|elt:' . UploadEnum::SLICE_MAX_SIZE,
            'suffix' => 'require|in:' . UploadEnum::SLICE_FILE_EXT,
        ];

        $msg = [
            'size.require'   => '文件大小不能为空',
            'size.elt'       => '文件大小不能大于' . FileUtil::formatBytes(UploadEnum::SLICE_MAX_SIZE),
            'suffix.require' => '文件格式不能为空',
            'suffix.in'      => '文件格式必须' . UploadEnum::SLICE_FILE_EXT,
        ];

        $Validate = Validate::make($rule, $msg);

        if (!$Validate->check($params)) {
            throw new ValidateException($Validate->getError());
        }

        return $this->saveSlice($params, $fileType);
    }
}