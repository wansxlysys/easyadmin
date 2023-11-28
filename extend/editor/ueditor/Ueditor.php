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
         * 上传文件
         */
        if ($action == 'file') {
            return $this->uploadFile();
        }

        /**
         * 列出图片
         */
        if ($action == 'listImage') {
            return $this->listImage();
        }

        /**
         * 列出文件
         */
        if ($action == 'listFile') {
            return $this->listFile();
        }

        return json(['state' => '请求类型出错']);
    }

    /**
     * 图片上传
     * @return Json
     */
    protected function uploadImage()
    {
        $config = [
            "maxSize"    => $this->config['imageMaxSize'],
            "allowFiles" => $this->config['imageAllowFiles'],
            "pathFormat" => $this->config['imagePathFormat'],
        ];

        $fieldName = $this->config['imageFieldName'];
        $Uploader  = new Uploader($fieldName, $config);

        return json($Uploader->getFileInfo());
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

    /**
     * 列出图片
     * @return Json
     */
    protected function listImage()
    {
        return json($this->listAnnex($this->config['imageManagerAllowFiles'], $this->config['imageManagerListSize'],
            $this->config['imageManagerListPath']));
    }

    /**
     * 列出指定文件类型文件类别
     * @param $allowFiles
     * @param $listSize
     * @param $path
     * @return array
     */
    protected function listAnnex($allowFiles, $listSize, $path)
    {
        $allowFiles = substr(str_replace(".", "|", join("", $allowFiles)), 1);

        // 获取参数
        $size  = request()->param('size', $listSize);
        $start = request()->param('start', 0);
        $end   = $start + $size;

        // 获取文件列表
        $path  = $_SERVER['DOCUMENT_ROOT'] . (substr($path, 0, 1) == "/" ? "" : "/") . $path;
        $files = $this->getFiles($path, $allowFiles);

        if (!count($files)) {
            return [
                "state" => "未查找到文件",
                "list"  => [],
                "start" => $start,
                "total" => count($files),
            ];
        }

        $len = count($files);
        for ($i = min($end, $len) - 1, $list = []; $i < $len && $i >= 0 && $i >= $start; $i--) {
            $list[] = $files[$i];
        }

        return [
            "state" => "SUCCESS",
            "list"  => $list,
            "start" => $start,
            "total" => count($files),
        ];
    }

    /**
     * 列出文件列表
     * @return Json
     */
    protected function listFile()
    {
        return json($this->listAnnex($this->config['fileManagerAllowFiles'], $this->config['fileManagerListSize'], $this->config['fileManagerListPath']));
    }

    /**
     * 遍历获取目录下的指定类型的文件
     * @param $path
     * @param $allowFiles
     * @param array $files
     * @return array|null
     */
    protected function getFiles($path, $allowFiles, &$files = [])
    {
        if (!is_dir($path)) {
            return null;
        }

        if (substr($path, strlen($path) - 1) != '/') {
            $path .= '/';
        }

        $handle = opendir($path);

        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                $nextPath = $path . $file;
                if (is_dir($nextPath)) {
                    $this->getFiles($nextPath, $allowFiles, $files);
                } else {
                    if (preg_match("/\.(" . $allowFiles . ")$/i", $file)) {
                        $files[] = [
                            'url'   => substr($nextPath, strlen($_SERVER['DOCUMENT_ROOT'])),
                            'mtime' => filemtime($nextPath),
                        ];
                    }
                }
            }
        }
        return $files;
    }
}
