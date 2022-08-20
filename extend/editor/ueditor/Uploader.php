<?php


namespace editor\ueditor;

class Uploader
{
    /**
     * 文件域名
     * @var string
     */
    private $fileField;

    /**
     * 文件上传对象
     * @var
     */
    private $file;

    /**
     * 配置信息
     * @var array
     */
    private $config;

    /**
     * 原始文件名
     * @var
     */
    private $oriName;

    /**
     * 新文件名
     * @var
     */
    private $fileName;

    /**
     * 完整文件名,即从当前配置目录开始的URL
     * @var
     */
    private $fullName;

    /**
     * 完整文件名,即从当前配置目录开始的URL
     * @var
     */
    private $filePath;

    /**
     * 文件大小
     * @var
     */
    private $fileSize;

    /**
     * 文件类型
     * @var
     */
    private $fileType;

    /**
     * 上传状态信息,
     * @var
     */
    private $stateInfo;

    /**
     * 上传类型
     * @var string
     */
    private $type;

    /**
     * 上传状态映射表，国际化用户需考虑此处数据的国际化
     * @var array
     */
    private $stateMap = [
        "SUCCESS",
        "文件大小超出 upload_max_filesize 限制",
        "文件大小超出 MAX_FILE_SIZE 限制",
        "文件未被完整上传",
        "没有文件被上传",
        "上传文件为空",
        "ERROR_TMP_FILE"           => "临时文件错误",
        "ERROR_TMP_FILE_NOT_FOUND" => "找不到临时文件",
        "ERROR_SIZE_EXCEED"        => "文件大小超出网站限制",
        "ERROR_TYPE_NOT_ALLOWED"   => "文件类型不允许",
        "ERROR_CREATE_DIR"         => "目录创建失败",
        "ERROR_DIR_NOT_WRITEABLE"  => "目录没有写权限",
        "ERROR_FILE_MOVE"          => "文件保存时出错",
        "ERROR_FILE_NOT_FOUND"     => "找不到上传文件",
        "ERROR_WRITE_CONTENT"      => "写入文件内容错误",
        "ERROR_UNKNOWN"            => "未知错误",
        "ERROR_DEAD_LINK"          => "链接不可用",
        "ERROR_HTTP_LINK"          => "链接不是http链接",
        "ERROR_HTTP_CONTENTTYPE"   => "链接contentType不正确",
        "INVALID_URL"              => "非法 URL",
        "INVALID_IP"               => "非法 IP",
    ];

    /**
     * 初始化
     * @param $fileField
     * @param $config
     * @param string $type
     */
    public function __construct($fileField, $config, $type = "upload")
    {
        $this->type      = $type;
        $this->config    = $config;
        $this->fileField = $fileField;

        if ($type == "base64") {
            $this->upBase64();
        } else {
            $this->upFile();
        }
    }

    /**
     * 上传文件的主处理方法
     * @return mixed
     */
    private function upFile()
    {
        $file = $this->file = $_FILES[$this->fileField];
        if (!$file) {
            $this->stateInfo = $this->getStateInfo("ERROR_FILE_NOT_FOUND");
            return;
        }
        if ($this->file['error']) {
            $this->stateInfo = $this->getStateInfo($file['error']);
            return;
        } else if (!file_exists($file['tmp_name'])) {
            $this->stateInfo = $this->getStateInfo("ERROR_TMP_FILE_NOT_FOUND");
            return;
        } else if (!is_uploaded_file($file['tmp_name'])) {
            $this->stateInfo = $this->getStateInfo("ERROR_TMPFILE");
            return;
        }

        $this->oriName  = $file['name'];
        $this->fileSize = $file['size'];
        $this->fileType = $this->getFileExt();
        $this->fullName = $this->getFullName();
        $this->filePath = $this->getFilePath();
        $this->fileName = $this->getFileName();
        $dirname        = dirname($this->filePath);

        //检查文件大小是否超出限制
        if (!$this->checkSize()) {
            $this->stateInfo = $this->getStateInfo("ERROR_SIZE_EXCEED");
            return;
        }

        //检查是否不允许的文件格式
        if (!$this->checkType()) {
            $this->stateInfo = $this->getStateInfo("ERROR_TYPE_NOT_ALLOWED");
            return;
        }

        //创建目录失败
        if (!file_exists($dirname) && !mkdir($dirname, 0777, true)) {
            $this->stateInfo = $this->getStateInfo("ERROR_CREATE_DIR");
            return;
        } else if (!is_writeable($dirname)) {
            $this->stateInfo = $this->getStateInfo("ERROR_DIR_NOT_WRITEABLE");
            return;
        }

        //移动文件
        if (!(move_uploaded_file($file["tmp_name"], $this->filePath) && file_exists($this->filePath))) {
            //移动失败
            $this->stateInfo = $this->getStateInfo("ERROR_FILE_MOVE");
        } else {
            //移动成功
            $this->stateInfo = $this->stateMap[0];
        }
    }

    /**
     * 处理base64编码的图片上传
     * @return mixed
     */
    private function upBase64()
    {
        $base64Data = $_POST[$this->fileField];
        $img        = base64_decode($base64Data);

        $this->oriName  = $this->config['oriName'];
        $this->fileSize = strlen($img);
        $this->fileType = $this->getFileExt();
        $this->fullName = $this->getFullName();
        $this->filePath = $this->getFilePath();
        $this->fileName = $this->getFileName();
        $dirname        = dirname($this->filePath);

        //检查文件大小是否超出限制
        if (!$this->checkSize()) {
            $this->stateInfo = $this->getStateInfo("ERROR_SIZE_EXCEED");
            return;
        }

        //创建目录失败
        if (!file_exists($dirname) && !mkdir($dirname, 0777, true)) {
            $this->stateInfo = $this->getStateInfo("ERROR_CREATE_DIR");
            return;
        } else if (!is_writeable($dirname)) {
            $this->stateInfo = $this->getStateInfo("ERROR_DIR_NOT_WRITEABLE");
            return;
        }

        //移动文件
        if (!(file_put_contents($this->filePath, $img) && file_exists($this->filePath))) {
            //移动失败
            $this->stateInfo = $this->getStateInfo("ERROR_WRITE_CONTENT");
        } else {
            //移动成功
            $this->stateInfo = $this->stateMap[0];
        }
    }

    /**
     * 上传错误检查
     * @param $errCode
     * @return string
     */
    private function getStateInfo($errCode)
    {
        return !$this->stateMap[$errCode] ? $this->stateMap["ERROR_UNKNOWN"] : $this->stateMap[$errCode];
    }

    /**
     * 获取文件扩展名
     * @return string
     */
    private function getFileExt()
    {
        return strtolower(strrchr($this->oriName, '.'));
    }

    /**
     * 重命名文件
     * @return string
     */
    private function getFullName()
    {
        //替换日期事件
        $name   = md5(uniqid() . time());
        $date   = explode('-', date("Y-y-m-d-H-i-s"));
        $format = $this->config["pathFormat"];
        $format = str_replace("{yyyy}", $date[0], $format);
        $format = str_replace("{yy}", $date[1], $format);
        $format = str_replace("{mm}", $date[2], $format);
        $format = str_replace("{dd}", $date[3], $format);
        $format = str_replace("{hh}", $date[4], $format);
        $format = str_replace("{ii}", $date[5], $format);
        $format = str_replace("{ss}", $date[6], $format);
        $format = str_replace("{md5}", $name, $format);

        //过滤文件名的非法自负,并替换文件名
        $oriName = substr($this->oriName, 0, strrpos($this->oriName, '.'));
        $oriName = preg_replace("/[\|\?\"\<\>\/\*\\\\]+/", '', $oriName);
        $format  = str_replace("{filename}", $oriName, $format);
        $ext     = $this->getFileExt();

        return $format . $ext;
    }

    /**
     * 获取文件名
     * @return string
     */
    private function getFileName()
    {
        return substr($this->filePath, strrpos($this->filePath, '/') + 1);
    }

    /**
     * 获取文件完整路径
     * @return string
     */
    private function getFilePath()
    {
        $fullname = $this->fullName;
        $rootPath = $_SERVER['DOCUMENT_ROOT'];

        if (substr($fullname, 0, 1) != '/') {
            $fullname = '/' . $fullname;
        }

        return $rootPath . $fullname;
    }

    /**
     * 文件类型检测
     * @return bool
     */
    private function checkType()
    {
        return in_array($this->getFileExt(), $this->config["allowFiles"]);
    }

    /**
     * 文件大小检测
     * @return bool
     */
    private function checkSize()
    {
        return $this->fileSize <= ($this->config["maxSize"]);
    }

    /**
     * 获取当前上传文件信息
     * @return array
     */
    public function getFileInfo()
    {
        return [
            "state"    => $this->stateInfo,
            "url"      => $this->fullName,
            "title"    => $this->fileName,
            "original" => $this->oriName,
            "type"     => $this->fileType,
            "size"     => $this->fileSize,
        ];
    }

}