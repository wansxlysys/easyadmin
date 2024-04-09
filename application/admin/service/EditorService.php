<?php


namespace app\admin\service;


use Throwable;

use think\File;
use think\facade\Config;

class EditorService extends \app\common\service\EditorService
{
    /**
     * 系统上传服务类
     * @var SystemUploadService
     */
    protected $SystemUploadService;

    /**
     * 初始化
     */
    public function initialize()
    {
        $this->SystemUploadService = new SystemUploadService();
    }

    /**
     * 配置
     * @return array
     */
    public function config()
    {
        return Config::pull('ueditor');
    }

    /**
     * 图片上传
     * @param File $file
     * @return array
     * @throws Throwable
     */
    public function uploadImage(File $file)
    {
        return $this->resultSet($this->SystemUploadService->uploadImage($file));
    }

    /**
     * 视频上传
     * @param File $file
     * @return array
     * @throws Throwable
     */
    public function uploadVideo(File $file)
    {
        return $this->resultSet($this->SystemUploadService->uploadVideo($file));
    }

    /**
     * 音频上传
     * @param File $file
     * @return array
     * @throws Throwable
     */
    public function uploadAudio(File $file)
    {
        return $this->resultSet($this->SystemUploadService->uploadAudio($file));
    }

    /**
     * 文件上传
     * @param File $file
     * @return array
     * @throws Throwable
     */
    public function uploadFile(File $file)
    {
        return $this->resultSet($this->SystemUploadService->uploadFile($file));
    }

    /**
     * 返回结果
     * @param $file
     * @return array
     */
    protected function resultSet($file)
    {
        if (!$file) {
            return ['state' => $this->SystemUploadService->getMessage()];
        }

        return ['state' => 'SUCCESS', 'url' => $file['view_path'], 'title' => $file['file_name'], 'original' => $file['file_name']];
    }
}