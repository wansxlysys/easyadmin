<?php


namespace app\admin\service;


use Exception;

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
    public function __construct()
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
     * @throws Exception
     */
    public function uploadImage(File $file)
    {
        return $this->resultSet($this->SystemUploadService->uploadImage($file));
    }

    /**
     * 视频上传
     * @param File $file
     * @return array
     * @throws Exception
     */
    public function uploadVideo(File $file)
    {
        return $this->resultSet($this->SystemUploadService->uploadVideo($file));
    }

    /**
     * 音频上传
     * @param File $file
     * @return array
     * @throws Exception
     */
    public function uploadAudio(File $file)
    {
        return $this->resultSet($this->SystemUploadService->uploadAudio($file));
    }

    /**
     * 文件上传
     * @param File $file
     * @return array
     * @throws Exception
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
        return ['state' => 'SUCCESS', 'url' => $file['viewPath'], 'title' => $file['fileName'], 'original' => $file['fileName']];
    }
}