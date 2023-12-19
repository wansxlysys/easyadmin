<?php


namespace editor\ueditor;


use think\response\Json;
use think\facade\Request;

class Ueditor
{
    /**
     * 编辑器配置
     * @var array
     */
    public $config = [];

    /**
     * 初始化
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 操作入口
     * @return Json
     */
    public function dispatch()
    {
        $action = Request::get('action');

        /**
         * 获取配置
         */
        if ($action == 'config') {
            return json($this->config);
        }

        /**
         * 上传图片
         */
        if ($action == 'image') {
            return $this->uploadImage();
        }

        /**
         * 上传视频
         */
        if ($action == 'video') {
            return $this->uploadVideo();
        }

        /**
         * 上传音频
         */
        if ($action == 'audio') {
            return $this->uploadVideo();
        }

        /**
         * 上传文件
         */
        if ($action == 'file') {
            return $this->uploadFile();
        }

        return json(['state' => '请求类型出错']);
    }

    /**
     * 图片上传
     * @return Json
     */
    protected function uploadImage()
    {
        $SystemUploadService = new \app\admin\service\SystemUploadService();

        // $result = $SystemUploadService->uploadImage(Request::file('file'));

        // halt($result);

        // $config = [
        //     "maxSize"    => $this->config['imageMaxSize'],
        //     "allowFiles" => $this->config['imageAllowFiles'],
        //     "pathFormat" => $this->config['imagePathFormat'],
        // ];

        // $fieldName = $this->config['imageFieldName'];
        // $Uploader  = new Uploader($fieldName, $config);

        // return json($Uploader->getFileInfo());
    }

    /**
     * 视频上传
     * @return Json
     */
    protected function uploadVideo()
    {
        $config = [
            "pathFormat" => $this->config['videoPathFormat'],
            "maxSize"    => $this->config['videoMaxSize'],
            "allowFiles" => $this->config['videoAllowFiles'],
        ];

        $fieldName = $this->config['videoFieldName'];
        $Uploader  = new Uploader($fieldName, $config);

        return json($Uploader->getFileInfo());
    }

    /**
     * 文件上传
     * @return Json
     */
    protected function uploadFile()
    {
        $config = [
            "pathFormat" => $this->config['filePathFormat'],
            "maxSize"    => $this->config['fileMaxSize'],
            "allowFiles" => $this->config['fileAllowFiles'],
        ];

        $fieldName = $this->config['fileFieldName'];
        $Uploader  = new Uploader($fieldName, $config);

        return json($Uploader->getFileInfo());
    }
}
